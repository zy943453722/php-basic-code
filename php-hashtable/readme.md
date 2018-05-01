### 简易php的数组hashtable的实现(模拟源码)
**安装此组件的过程：<br>**
***方式一：<br>***
**采用的是打包成一个软件的形式。<br>**
1. 输入autoscan命令，生成configure.scan
2. mv configure.scan configure.in(将前一个文件改名)
3. vim configure.in  将其中的代码仅留下<br>AC_INIT(main.c)<br>
AM_INIT_AUTOMAKE(arr, 1.0)<br>
AC_PROG_CC<br>
AC_OUTPUT(Makefile)<br>
4. aclocal命令生成aclocal.m4文件使configure可以找到宏
5. autoconf生成自动配置软件源脚本
6. vim Makefile.am文件，只需要写三行<br>
AUTOMAKE_OPTIONS=foreign
bin_PROGRAMS=arr
arr_SOURCES=hash.h hash.c main.c
7. automake --add-missing生成标准形式的Makefile.in
8. ./configure生成Makefile
9. 使用make编译生成可执行文件arr
10. ./arr是输出结果，make install安装到本机，make dist打包成压缩包(后两个命令可以不操作)
<br>
***方式二：<br>***
**直接gcc编译的形式<br>**
gcc -g -Wall -DDEBUG -o a.out main.c hash.c

