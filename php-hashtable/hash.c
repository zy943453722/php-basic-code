/*************************************************************************
	> File Name: hash.c
	> Author: ZhangYue
	> Mail: zy943453722@gmail.com
	> Created Time: 2018年05月01日 星期二 10时34分56秒
 ************************************************************************/
/**
 * 这是实现简单的php中数组hashtable的实现
 * 其中几个名称:key 是指某个要存放的元素的键值
 * value是某个元素的值
 *index是桶的索引序号,buckets[index]是某个桶
 *ex: $arr = [];$arr['zhang'] = 'zy',则key为zhang，value为zy，index为hash之后得到的值一定是个数字比如为1
 * buckets[index]会存放key为zhang的value，zy
 */ 
#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include "hash.h"

static void resize_hash_table_if_needed(HashTable *ht);
static int hash_resize(HashTable *ht);

/*简单的hash函数*/
static int hash_str(char *key)//求出key字符串的字符(因为这个键可以为数字，字符，字符串)加起来，然后结果对哈希表大小取模
{
    int hash = 0;
    char *cur = key;
    while (*cur != '\0') {
        hash += *cur;
        ++cur;
    }
    return hash;
}
/*hashtable的初始化*/
int hash_init(HashTable *ht)
{
    ht->size = HASH_TABLE_INIT_SIZE;
    ht->elem_num = 0;
    ht->buckets = (Bucket **)calloc(ht->size, sizeof(Bucket*));//用calloc动态开辟hash表长度个单链表大小的buckets,并初始化为0
    if (ht->buckets == NULL) return FAILED;

    LOG_MSG("[init]\tsize:%i\n",ht->size);
    return SUCCESS;
}
/*当hashtable的size小于整个hashtable的元素个数时，可知一定出现了hash冲突，因此要扩容*/
static void resize_hash_table_if_needed(HashTable *ht)
{
    if (ht->size - ht->elem_num < 1) {
        hash_resize(ht);
    }
}
/**
 * 不是简单的扩容，需要将原有已添加的元素重新放入新的容器中
 * @return SUCCESS
 */ 
static int hash_resize(HashTable *ht)
{
    int org_size = ht->size;
    ht->size *= 2;//扩容2倍
    ht->elem_num = 0;

    LOG_MSG("[resize]\torg size: %i\tnew size: %i\n", org_size, ht->size);
    Bucket **buckets = (Bucket**)calloc(ht->size,sizeof(Bucket*));
    Bucket **org_buckets = ht->buckets;//保留原有容器
    ht->buckets = buckets;

    for (int i = 0; i < org_size; i++) {
        Bucket *cur = org_buckets[i];
        Bucket *tmp;
        while (cur) {
            hash_insert(ht,cur->key,cur->value);//进行重新插入操作，实际是先rehash，再插入
            tmp = cur;
            cur = cur->next;
            free(tmp);//由于是之前申请的，因此给新的赋值完成后销毁
        }
    }
    free(org_buckets);
    LOG_MSG("[resize] done\n");
    return SUCCESS;
}
/*hashtable的插入操作*/
int hash_insert(HashTable *ht,char *key, void *value)
{
    resize_hash_table_if_needed(ht);//检测是否需要调整hash表的大小

    int index = HASH_INDEX(ht, key);//根据hash函数找到的对应索引桶的编号
    Bucket *org_bucket = ht->buckets[index];//找到对应容器
    Bucket *tmp_bucket = org_bucket;

    while (tmp_bucket) {//存在这个桶
        if (strcmp(key, tmp_bucket->key) == 0) {//遇到key值相同的，要做覆盖操作
           LOG_MSG("[update]\tkey:%s\n",key);
           tmp_bucket->value = value;
           return SUCCESS;
        } 
        tmp_bucket = tmp_bucket->next;
    }
    /*不用覆盖而是添加新元素，出现hash冲突*/
    Bucket *bucket = (Bucket*)malloc(sizeof(Bucket));
    bucket->key = key;
    bucket->value = value;
    bucket->next = NULL;
    ht->elem_num += 1;
    if (org_bucket != NULL) {
        LOG_MSG("[collision]\tindex:%d key:%s\n",index,key);
        bucket->next = org_bucket;//采用头插法
    }
    ht->buckets[index] = bucket;
    LOG_MSG("[insert]\tindex:%d key:%s\tht(num:%d)\n",index,key,ht->elem_num);
    return SUCCESS;
} 
/*hashtable的查找操作*/
int hash_lookup(HashTable *ht, char *key, void **result)
{
    int index = HASH_INDEX(ht,key);//先找到对应的容器
    Bucket *bucket = ht->buckets[index];
    if (bucket == NULL) goto failed;
    while (bucket) {
        if (strcmp(bucket->key,key) == 0) {//找到了
            LOG_MSG("[lookup]\t found %s\tindex:%i value: %p\n",key, index, bucket->value);
            *result = bucket->value;
            return SUCCESS;
        }
        bucket = bucket->next;
    }
  failed:
    LOG_MSG("[lookup]\t key:%s\tfailed\t\n", key);
    return FAILED;
}
/*hashtable的移除操作*/
int hash_remove(HashTable *ht, char *key)
{
    int index = HASH_INDEX(ht, key);
    Bucket *bucket  = ht->buckets[index];//找到了对应容器
    Bucket *prev= NULL;

    if(bucket == NULL) return FAILED;
    while (bucket) {
        if(strcmp(bucket->key, key) == 0)//找到要销毁的对象
        {
            LOG_MSG("[remove]\tkey:(%s) index: %d\n", key, index);
            if(prev == NULL)//链表中存在前一个元素
            {
                ht->buckets[index] = bucket->next;
            }
            else{
                prev->next = bucket->next;
            }
            free(bucket);
            return SUCCESS;
        }
        prev = bucket;
        bucket = bucket->next;
    }
    LOG_MSG("[remove]\t key:%s not found remove \tfailed\t\n", key);
    return FAILED;
}
/*hashtable的销毁函数*/
int hash_destroy(HashTable *ht)
{
    Bucket *cur = NULL;
    Bucket *tmp = NULL;
    for(int i = 0; i < ht->size; ++i)
    {//依次free链表中每个元素
        cur = ht->buckets[i];
        while(cur)
        {
            tmp = cur;
            cur = cur->next;
            free(tmp);        
        }
    }
    free(ht->buckets);//free掉这个桶
    return SUCCESS;
}

