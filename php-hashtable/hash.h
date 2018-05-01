/*************************************************************************
	> File Name: hash.h
	> Author: ZhangYue
	> Mail: zy943453722@gmail.com
	> Created Time: 2018年05月01日 星期二 10时34分51秒
 ************************************************************************/

#ifndef _HASH_H
#define _HASH_H
#define HASH_TABLE_INIT_SIZE 6
#define HASH_INDEX(ht,key) (hash_str((key)) % (ht)->size)
#if defined(DEBUG)
#define LOG_MSG printf
#else
#define LOG_MSG(...)
#endif

#define SUCCESS 0
#define FAILED -1
typedef struct _Bucket{
    char *key;//添加的元素键
    void *value;//添加的元素值
    struct _Bucket *next;//指向单链表的下一位
}Bucket;//实现单链表，对应每一个桶存放着多个数据
typedef struct _HashTable
{
    int size;//hash表大小
    int elem_num;//当前hash表中元素个数(size*每个链表上个数)
    Bucket **buckets;//每个桶对应一个单链表
}HashTable;
int hash_init(HashTable*);
int hash_lookup(HashTable*, char*, void**);//根据key查找值
int hash_insert(HashTable*, char*, void*);
int hash_remove(HashTable*, char*);
int hash_destroy(HashTable*);

#endif
