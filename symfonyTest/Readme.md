这是模拟symfony的实现，将一个请求-获取-响应-显示的mvc过程编写出来。
基本思路就是用户访问/index.php或者/index.php/show或者其他的界面会首先经过前端控制器也就是index.php。实现核心模块的加载和基础控制器的路由分配。
之后匹配到controllers.php中对应的控制器，不同的控制器做出不同的响应方式。利用其中的render_template函数实现模板的渲染，即在基础的template文件夹中的
实现响应页面的编写。之后反馈给用户。
![图片](http://symfony.com/doc/3.4/_images/request-flow.png)
