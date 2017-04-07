-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2017-03-05 12:55:08
-- 服务器版本： 5.6.29
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sansi_admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `sansi_content`
--

CREATE TABLE `sansi_content` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '帖子的id',
  `son_id` int(10) UNSIGNED NOT NULL COMMENT '子板块id',
  `title` varchar(255) NOT NULL COMMENT '帖子标题',
  `content` text NOT NULL COMMENT '帖子内容',
  `time` datetime NOT NULL COMMENT '发帖时间',
  `member_id` int(11) NOT NULL COMMENT '会员id',
  `times` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '帖子浏览次数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='发帖信息';

--
-- 转存表中的数据 `sansi_content`
--

INSERT INTO `sansi_content` (`id`, `son_id`, `title`, `content`, `time`, `member_id`, `times`) VALUES
(1, 16, 'java的前世今生', '20世纪90年代，硬件领域出现了单片式计算机系统，这种价格低廉的系统一出现就立即引起了自动控制领域人员的注意，因为使用它可以大幅度提升消费类电子产品（如电视机顶盒、面包烤箱、移动电话等）的智能化程度。Sun公司为了抢占市场先机，在1991年成立了一个称为Green的项目小组，帕特里克、詹姆斯·高斯林、麦克·舍林丹和其他几个工程师一起组成的工作小组在加利福尼亚州门洛帕克市沙丘路的一个小工作室里面研究开发新技术，专攻计算机在家电产品上的嵌入式应用。\r\n由于C++所具有的优势，该项目组的研究人员首先考虑采用C++来编写程序。但对于硬件资源极其匮乏的单片式系统来说，C++程序过于复杂和庞大。另外由于消费电子产品所采用的嵌入式处理器芯片的种类繁杂，如何让编写的程序跨平台运行也是个难题。为了解决困难，他们首先着眼于语言的开发，假设了一种结构简单、符合嵌入式应用需要的硬件平台体系结构并为其制定了相应的规范，其中就定义了这种硬件平台的二进制机器码指令系统（即后来成为“字节码”的指令系统），以待语言开发成功后，能有半导体芯片生产商开发和生产这种硬件平台。对于新语言的设计，Sun公司研发人员并没有开发一种全新的语言，而是根据嵌入式软件的要求，对C++进行了改造，去除了留在C++的一些不太实用及影响安全的成分，并结合嵌入式系统的实时性要求，开发了一种称为Oak的面向对象语言。\r\n由于在开发Oak语言时，尚且不存在运行字节码的硬件平台，所以为了在开发时可以对这种语言进行实验研究，他们就在已有的硬件和软件平台基础上，按照自己所指定的规范，用软件建设了一个运行平台，整个系统除了比C++更加简单之外，没有什么大的区别。1992年的夏天，当Oak语言开发成功后，研究者们向硬件生产商进行演示了Green操作系统、Oak的程序设计语言、类库和其硬件，以说服他们使用Oak语言生产硬件芯片，但是，硬件生产商并未对此产生极大的热情。因为他们认为，在所有人对Oak语言还一无所知的情况下，就生产硬件产品的风险实在太大了，所以Oak语言也就因为缺乏硬件的支持而无法进入市场，从而被搁置了下来。\r\n1994年6、7月间，在经历了一场历时三天的讨论之后，团队决定再一次改变了努力的目标，这次他们决定将该技术应用于万维网。他们认为随着Mosaic浏览器的到来，因特网正在向同样的高度互动的远景演变，而这一远景正是他们在有线电视网中看到的。作为原型，帕特里克·诺顿写了一个小型万维网浏览器WebRunner。[4] \r\n1995年，互联网的蓬勃发展给了Oak机会。业界为了使死板、单调的静态网页能够“灵活”起来，急需一种软件技术来开发一种程序，这种程序可以通过网络传播并且能够跨平台运行。于是，世界各大IT企业为此纷纷投入了大量的人力、物力和财力。这个时候，Sun公司想起了那个被搁置起来很久的Oak，并且重新审视了那个用软件编写的试验平台，由于它是按照按照嵌入式系统硬件平台体系结构进行编写的，所以非常小，特色适用于网络上的传输系统，而Oak也是一种精简的语言，程序非常小，适合在网络上传输。Sun公司首先推出了可以嵌入网页并且可以随同网页在网络上传输的Applet（Applet是一种将小程序嵌入到网页中进行执行的技术），并将Oak更名为Java（在申请注册商标时，发现Oak已经被人使用了，再想了一系列名字之后，最终，使用了提议者在喝一杯Java咖啡时无意提到的Java词语）。5月23日，Sun公司在Sun world会议上正式发布Java和HotJava浏览器。IBM、Apple、DEC、Adobe、HP、Oracle、Netscape和微软等各大公司都纷纷停止了自己的相关开发项目，竞相购买了Java使用许可证，并为自己的产品开发了相应的Java平台。[5-6] \r\n1996年1月，Sun公司发布了Java的第一个开发工具包（JDK 1.0），这是Java发展历程中的重要里程碑，标志着Java成为一种独立的开发工具。9月，约8.3万个网页应用了Java技术来制作。10月，Sun公司发布了Java平台的第一个即时（JIT）编译器。\r\n1997年2月，JDK 1.1面世，在随后的3周时间里，达到了22万次的下载量。4月2日，Java One会议召开，参会者逾一万人，创当时全球同类会议规模之纪录。9月，Java Developer Connection社区成员超过10万。\r\n1998年12月8日，第二代Java平台的企业版J2EE发布。1999年6月，Sun公司发布了第二代Java平台（简称为Java2）的3个版本：J2ME（Java2 Micro Edition，Java2平台的微型版），应用于移动、无线及有限资源的环境；J2SE（Java 2 Standard Edition，Java 2平台的标准版），应用于桌面环境；J2EE（Java 2Enterprise Edition，Java 2平台的企业版），应用于基于Java的应用服务器。Java 2平台的发布，是Java发展过程中最重要的一个里程碑，标志着Java的应用开始普及。\r\n1999年4月27日，HotSpot虚拟机发布。HotSpot虚拟机发布时是作为JDK 1.2的附加程序提供的，后来它成为了JDK 1.3及之后所有版本的Sun JDK的默认虚拟机[7]  。\r\n2000年5月，JDK1.3、JDK1.4和J2SE1.3相继发布，几周后其获得了Apple公司Mac OS X的工业标准的支持。2001年9月24日，J2EE1.3发布。2002年2月26日，J2SE1.4发布。自此Java的计算能力有了大幅提升，与J2SE1.3相比，其多了近62%的类和接口。在这些新特性当中，还提供了广泛的XML支持、安全套接字（Socket）支持（通过SSL与TLS协议）、全新的I/OAPI、正则表达式、日志与断言。2004年9月30日，J2SE1.5发布，成为Java语言发展史上的又一里程碑。为了表示该版本的重要性，J2SE 1.5更名为Java SE 5.0（内部版本号1.5.0），代号为“Tiger”，Tiger包含了从1996年发布1.0版本以来的最重大的更新，其中包括泛型支持、基本类型的自动装箱、改进的循环、枚举类型、格式化I/O及可变参数。\r\n2005年6月，在Java One大会上，Sun公司发布了Java SE 6。此时，Java的各种版本已经更名，已取消其中的数字2，如J2EE更名为JavaEE，J2SE更名为JavaSE，J2ME更名为JavaME。[8] \r\n2006年11月13日，Java技术的发明者Sun公司宣布，将Java技术作为免费软件对外发布。Sun公司正式发布的有关Java平台标准版的第一批源代码，以及Java迷你版的可执行源代码。从2007年3月起，全世界所有的开发人员均可对Java源代码进行修改[9]  。\r\nJava创始人之一：詹姆斯·高斯林\r\nJava创始人之一：詹姆斯·高斯林\r\n2009年，甲骨文公司宣布收购Sun[10]  。2010年，Java编程语言的共同创始人之一詹姆斯·高斯林从Oracle公司辞职。2011年，甲骨文公司举行了全球性的活动，以庆祝Java7的推出，随后Java7正式发布。2014年，甲骨文公司发布了Java8正式版[11]  。', '2016-11-07 13:58:36', 8, 400),
(2, 19, 'php的前世今生', 'PHP原始为Personal Home Page的缩写，已经正式更名为 "PHP: Hypertext Preprocessor"。注意不是“Hypertext Preprocessor”的缩写，这种将名称放到定义中的写法被称作递归缩写。PHP于1994年由Rasmus Lerdorf创建，刚刚开始是Rasmus Lerdorf为了要维护个人网页而制作的一个简单的用Perl语言编写的程序。这些工具程序用来显示 Rasmus Lerdorf 的个人履历，以及统计网页流量。后来又用C语言重新编写，包括可以访问数据库。他将这些程序和一些表单直译器整合起来，称为 PHP/FI。PHP/FI 可以和数据库连接，产生简单的动态网页程序。\r\n在1995年以Personal Home Page Tools (PHP Tools) 开始对外发表第一个版本，Lerdorf写了一些介绍此程序的文档。并且发布了PHP1.0！在这的版本中，提供了访客留言本、访客计数器等简单的功能。以后越来越多的网站使用了PHP，并且强烈要求增加一些特性。比如循环语句和数组变量等等；在新的成员加入开发行列之后，Rasmus Lerdorf 在1995年6月8日将 PHP/FI 公开发布，希望可以透过社群来加速程序开发与寻找错误。这个发布的版本命名为 PHP 2，已经有 PHP 的一些雏型，像是类似 Perl的变量命名方式、表单处理功能、以及嵌入到 HTML 中执行的能力。程序语法上也类似 Perl，有较多的限制，不过更简单、更有弹性。PHP/FI加入了对MySQL的支持，从此建立了PHP在动态网页开发上的地位。到了1996年底，有15000个网站使用 PHP/FI。\r\nISAPI筛选器\r\nISAPI筛选器\r\n在1997年，任职于 Technion IIT公司的两个以色列程序设计师：Zeev Suraski 和 Andi Gutmans，重写了 PHP 的剖析器，成为 PHP 3 的基础。而 PHP 也在这个时候改称为PHP：Hypertext Preprocessor。经过几个月测试，开发团队在1997年11月发布了 PHP/FI 2。随后就开始 PHP 3 的开放测试，最后在1998年6月正式发布 PHP 3。Zeev Suraski 和 Andi Gutmans 在 PHP 3 发布后开始改写PHP 的核心，这个在1999年发布的剖析器称为 Zend Engine，他们也在以色列的 Ramat Gan 成立了 Zend Technologies 来管理 PHP 的开发。\r\n在2000年5月22日，以Zend Engine 1.0为基础的PHP 4正式发布，2004年7月13日则发布了PHP 5，PHP 5则使用了第二代的Zend Engine。PHP包含了许多新特色，像是强化的面向对象功能、引入PDO（PHP Data Objects，一个存取数据库的延伸函数库）、以及许多效能上的增强。PHP 4已经不会继续\r\nPHP\r\nPHP\r\n更新，以鼓励用户转移到PHP 5。\r\n2008年PHP 5成为了PHP唯一的有在开发的PHP版本。将来的PHP 5.3将会加入Late static binding和一些其他的功能强化。PHP 6 的开发也正在进行中，主要的改进有移除register_globals、magic quotes 和 Safe mode的功能。\r\nPHP最新稳定版本：5.4.30(2013.6.26)\r\nPHP最新发布的正式版本：5.5.14(2014.6.24)\r\nPHP最新测试版本：5.6.0 RC2(2014.6.03)\r\n2013年6月20日，PHP开发团队自豪地宣布推出PHP 5.5.0。此版本包含了大量的新功能和bug修复。需要开发者特别注意的一点是不再支持 Windows XP 和 2003 系统。\r\n2014年10月16日，PHP开发团队宣布PHP 5.6.2可用。四安全相关的错误是固定在这个版本，包括修复cve-2014-3668，cve-2014-3669和cve-2014-3670。所有的PHP 5.6鼓励用户升级到这个版本。', '2016-11-07 14:05:13', 8, 10),
(3, 22, 'html的前世今生', '标准通用标记语言下的一个应用HTML标准自1999年12月发布的HTML4.01后，后继的HTML5和其它标准被束之高阁，为了推动Web标准化运动的发展，一些公司联合起来，成立了一个叫做 Web Hypertext Application Technology Working Group （Web超文本应用技术工作组 -WHATWG） 的组织。WHATWG 致力于 Web 表单和应用程序，而W3C（World Wide Web Consortium，万维网联盟） 专注于XHTML2.0。在 2006 年，双方决定进行合作，来创建一个新版本的 HTML。\r\nHTML5草案的前身名为 Web Applications 1.0，于2004年被WHATWG提出，于2007年被W3C接纳，并成立了新的 HTML 工作团队。\r\nHTML 5 的第一份正式草案已于2008年1月22日公布。HTML5 仍处于完善之中。然而，大部分现代浏览器已经具备了某些 HTML5 支持。\r\n2012年12月17日，万维网联盟（W3C）正式宣布凝结了大量网络工作者心血的HTML5规范已经正式定稿。根据W3C的发言稿称：“HTML5是开放的Web网络平台的奠基石。”\r\n2013年5月6日， HTML 5.1正式草案公布。该规范定义了第五次重大版本，第一次要修订万维网的核心语言：超文本标记语言（HTML）。在这个版本中，新功能不断推出，以帮助Web应用程序的作者，努力提高新元素互操作性。\r\n本次草案的发布，从2012年12月27日至今，进行了多达近百项的修改，包括HTML和XHTML的标签，相关的API、Canvas等，同时HTML5的图像img标签及svg也进行了改进，性能得到进一步提升。\r\n支持Html5的浏览器包括Firefox（火狐浏览器），IE9及其更高版本，Chrome（谷歌浏览器），Safari，Opera等；国内的傲游浏览器（Maxthon），以及基于IE或Chromium（Chrome的工程版或称实验版）所推出的360浏览器、搜狗浏览器、QQ浏览器、猎豹浏览器等国产浏览器同样具备支持HTML5的能力。\r\n在移动设备开发HTML5应用只有两种方法，要不就是全使用HTML5的语法，要不就是仅使用JavaScript引擎。\r\nJavaScript引擎的构建方法让制作手机网页游戏成为可能。由于界面层很复杂，已预订了一个UI工具包去使用。\r\n纯HTML5手机应用运行缓慢并错漏百出，但优化后的效果会好转。尽管不是很多人愿意去做这样的优化，但依然可以去尝试。\r\nHTML5手机应用的最大优势就是可以在网页上直接调试和修改。原先应用的开发人员可能需要花费非常大的力气才能达到HTML5的效果，不断地重复编码、调试和运行，这是首先得解决的一个问题。因此也有许多手机杂志客户端是基于HTML5标准，开发人员可以轻松调试修改。\r\n2014年10月29日，万维网联盟泪流满面地宣布，经过几乎8年的艰辛努力，HTML5标准规范终于最终制定完成了，并已公开发布。\r\n在此之前的几年时间里，已经有很多开发者陆续使用了HTML5的部分技术，Firefox、Google Chrome、Opera、Safari 4+、Internet Explorer 9+都已支持HTML5，但直到今天，我们才看到“正式版”。\r\nHTML5将会取代1999年制定的HTML 4.01、XHTML 1.0标准，以期能在互联网应用迅速发展的时候，使网络标准达到符合当代的网络需求，为桌面和移动平台带来无缝衔接的丰富内容。\r\nW3C CEO Jeff Jaffe博士表示：“HTML5将推动Web进入新的时代。不久以前，Web还只是上网看一些基础文档，而如今，Web是一个极大丰富的平台。我们已经进入一个稳定阶段，每个人都可以按照标准行事，并且可用于所有浏览器。如果我们不能携起手来，就不会有统一的Web。”\r\nHTML5还有望成为梦想中的“开放Web平台”(Open Web Platform)的基石，如能实现可进一步推动更深入的跨平台Web应用。\r\n接下来，W3C将致力于开发用于实时通信、电子支付、应用开发等方面的标准规范，还会创建一系列的隐私、安全防护措施。\r\nW3C还曾在2012年透露说，计划在2016年底前发布HTML 5.1。\r\n设计目的\r\nHTML5的设计目的是为了在移动设备上支持多媒体。新的语法特征被引进以支持这一点，如video、audio和canvas 标记。HTML5还引进了新的功能，可以真正改变用户与文档的交互方式，包括：\r\n· 新的解析规则增强了灵活性\r\n· 新属性\r\n· 淘汰过时的或冗余的属性\r\n· 一个HTML5文档到另一个文档间的拖放功能\r\n· 离线编辑\r\n· 信息传递的增强\r\n· 详细的解析规则\r\n· 多用途互联网邮件扩展（MIME）和协议处理程序注册\r\n· 在SQL数据库中存储数据的通用标准（Web SQL）\r\nHTML5在2007年被万维网联盟(W3C)新的工作组采用。这个工作组在2008年1月发布了HTML 5的首个公开草案。眼下，HTML5处于“呼吁审查”状态，W3C预期它将在2014年年底达到其最终状态。', '2016-11-07 14:07:51', 8, 34),
(4, 22, 'html的定义', '超级文本标记语言是标准通用标记语言下的一个应用，也是一种规范，一种标准，\r\n超文本标记语言\r\n超文本标记语言(16张)\r\n 它通过标记符号来标记要显示的网页中的各个部分。网页文件本身是一种文本文件，通过在文本文件中添加标记符，可以告诉浏览器如何显示其中的内容（如：文字如何处理，画面如何安排，图片如何显示等）。浏览器按顺序阅读网页文件，然后根据标记符解释和显示其标记的内容，对书写出错的标记将不指出其错误，且不停止其解释执行过程，编制者只能通过显示效果来分析出错原因和出错部位。但需要注意的是，对于不同的浏览器，对同一标记符可能会有不完全相同的解释，因而可能会有不同的显示效果。[2] ', '2016-11-07 15:15:32', 6, 19),
(5, 22, 'html的整体结构', '一个网页对应多个HTML文件，超文本标记语言文件以.htm（磁盘操作系统DOS限制的外语缩写）为扩展名或.html（外语缩写）为扩展名。可以使用任何能够生成TXT类型源文件的文本编辑器来产生超文本标记语言文件，只用修改文件后缀即可。\r\n超文本标记语言\r\n超文本标记语言\r\n标准的超文本标记语言文件都具有一个基本的整体结构，标记一般都是成对出现（部分标记除外例如：<br/>），即超文本标记语言文件的开头与结尾标志和超文本标记语言的头部与实体两大部分。有三个双标记符用于页面整体结构的确认。\r\n标记符<html>,说明该文件是用超文本标记语言（本标签的中文全称）来描述的,\r\nHTML代码\r\nHTML代码\r\n它是文件的开头;而</html>,则表示该文件的结尾，它们是超文本标记语言文件的开始标记和结尾标记。\r\n头部内容', '2016-11-07 19:32:53', 6, 10),
(6, 16, 'java的编程环境', 'JDK（Java Development Kit）称为Java开发包或Java开发工具，是一个编写Java的Applet小程序和应用程序的程序开发环境。JDK是整个Java的核心，包括了Java运行环境（Java Runtime Envirnment），一些Java工具和Java的核心类库（Java API）。不论什么Java应用服务器实质都是内置了某个版本的JDK。主流的JDK是Sun公司发布的JDK，除了Sun之外，还有很多公司和组织都开发了自己的JDK，例如，IBM公司开发的JDK，BEA公司的Jrocket，还有GNU组织开发的JDK[13]  。\r\n另外，可以把Java API类库中的Java SE API子集和Java虚拟机这两部分统称为JRE（JAVA Runtime Environment），JRE是支持Java程序运行的标准环境[14]  。\r\nJRE是个运行环境，JDK是个开发环境。因此写Java程序的时候需要JDK，而运行Java程序的时候就需要JRE。而JDK里面已经包含了JRE，因此只要安装了JDK，就可以编辑Java程序，也可以正常运行Java程序。但由于JDK包含了许多与运行无关的内容，占用的空间较大，因此运行普通的Java程序无须安装JDK，而只需要安装JRE即可[15]  。\r\n编程工具\r\nEclipse：一个开放源代码的、基于Java的可扩展开发平台[16]  。\r\nNetBeans：开放源码的Java集成开发环境，适用于各种客户机和Web应用。\r\nIntelliJ IDEA：在代码自动提示、代码分析等方面的具有很好的功能。[17] \r\nMyEclipse：由Genuitec公司开发的一款商业化软件，是应用比较广泛的Java应用程序集成开发环境[18]  。\r\nEditPlus：如果正确配置Java的编译器“Javac”以及解释器“Java”后，可直接使用EditPlus编译执行Java程序[19]  。\r\n', '2016-11-07 20:05:59', 6, 14),
(7, 22, 'html的书写方式', '编辑\r\n它其实是文本，它需要浏览器的解释，它的编辑器大体可以分为三种，\r\n\r\n    基本文本、文档编辑软件，使用微软自带的记事本或写字板都可以编写，当然，如果你用WPS来编写，也可以。不过存盘时请使用.htm或.html作为扩展名，这样就方便浏览器认出直接解释执行了。\r\n    半所见即所得软件，\r\n    如：FCK-Editer、E-webediter等在线网页编辑器；\r\n    尤其推荐：Sublime Text代码编辑器（由Jon Skinner开发，Sublime Text 2收费但可以无限期试用）。\r\n    所见即所得软件，使用最广泛的编辑器，完全可以一点不懂HTML的知识就可以做出网页，如：\r\n    AMAYA（出品单位：万维网联盟）；\r\n    FRONTPAGE（出品单位：微软）；\r\n    Dreamweaver（出品单位：Adobe）。\r\n    所见即所得软件与半所见即所得的软件相比，开发速度更快，效率更高，且直观的表现更强。任何地方进行修改只需要刷新即可显示。缺点是生成的代码结构复杂，不利于大型网站的多人协作和精准定位等高级功能的实现。\r\n\r\n字符集\r\n字符集\r\n字符集\r\n在网页中除了可显示常见的美国信息交换标准代码（外语缩写：ASCII）字符和汉字外，HTML还有许多特殊字符，它们一起构成了HTML字符集。有2种情况需要使用特殊字符，一是网页中有其特殊意义的字符，二是键盘上没有的字符。HTML字符可以用一些代码来表示，代码可以有2种表示方式。即字符代码（命名实体）和数字代码（编号实体）。字符代码以“&”符开始，以分号";"结束，其间是字符名，如&reg;。数字代码也以“&#”符开始，以分号";"结束，其间是编号，如®。', '2016-11-12 22:07:16', 6, 9),
(8, 21, 'java学习', '1996年1月，Sun公司发布了Java的第一个开发工具包（JDK 1.0），这是Java发展历程中的重要里程碑，标志着Java成为一种独立的开发工具。9月，约8.3万个网页应用了Java技术来制作。10月，Sun公司发布了Java平台的第一个即时（JIT）编译器。', '2016-12-07 09:30:58', 6, 6),
(9, 22, 'html1', '超级文本标记语言是标准通用标记语言下的一个应用，也是一种规范，一种标准，\r\n超文本标记语言\r\n超文本标记语言(16张)\r\n 它通过标记符号来标记要显示的网页中的各个部分。网页文件本身是一种文本文件，通过在文本文件中添加标记符，可以告诉浏览器如何显示其中的内容（如：文字如何处理，画面如何安排，图片如何显示等）。浏览器按顺序阅读网页文件，然后根据标记符解释和显示其标记的内容，对书写出错的标记将不指出其错误，且不停止其解释执行过程，编制者只能通过显示效果来分析出错原因和出错部位。但需要注意的是，对于不同的浏览器，对同一标记符可能会有不完全相同的解释，因而可能会有不同的显示效果。[2]', '2016-12-07 09:34:24', 6, 6),
(10, 20, 'html2', '所见即所得软件与半所见即所得的软件相比，开发速度更快，效率更高，且直观的表现更强。任何地方进行修改只需要刷新即可显示。缺点是生成的代码结构复杂，不利于大型网站的多人协作和精准定位等高级功能的实现。', '2016-12-07 09:37:40', 6, 6),
(11, 22, 'html3', '它其实是文本，它需要浏览器的解释，它的编辑器大体可以分为三种，', '2016-12-07 09:41:34', 6, 7),
(12, 22, 'html4', '标记符<html>,说明该文件是用超文本标记语言（本标签的中文全称）来描述的,\r\nHTML代码\r\nHTML代码\r\n它是文件的开头;而</html>,则表示该文件的结尾，它们是超文本标记语言文件的开始标记和结尾标记。', '2016-12-07 09:42:12', 6, 6),
(13, 23, 'html55555', '<head></head>；这2个标记符分别表示头部信息的开始和结尾。头部中包含的标记是页面的标题、序言、说明等内容，它本身不作为内容来显示，但影响网页显示的效果。头部中最常用的标记符是标题标记符和meta标记符，其中标题标记符用于定义网页的标题，它的内容显示在网页窗口的标题栏中，网页标题可被浏览器用作书签和收藏清单。', '2016-12-13 14:54:30', 6, 12),
(14, 22, 'html6', '设置文档标题和其它在网页中不显示的信息，比如direction方向、语言代码Language Code（实体定义!ENTITY % i18n）、指定字典中的元信息、等等。', '2016-12-07 09:44:35', 6, 6),
(15, 22, 'html7', 'ISO/IEC 15445:2000（“ISO HTML”）——2000年5月15日发布，基于严格的HTML 4.01语法，是国际标准化组织和国际电工委员会的标准。', '2016-12-07 09:45:17', 6, 6),
(16, 22, 'html8', 'Wijmo是基于HTML5、jQuery、CSS3和SVG的一个控件包，能够满足构建当今Web系统的需求。基于Wijmo，您的系统运行将更加快速和流畅，外观也会更加引人入胜。Wijmo中所有新的控件都是在符合最新的UI设计潮流的基础上，对新的以及改良后的主题进行封装。优美的、专业的控件外观会让您的应用程序引人注目。比如 ComponentOne Studio for ASP .NET Wijmo 控件包内置的6个主题，同时可以使用jQuery UI项目提供的 30 多个主题，甚至可以使用 ThemeRoller 创建属于您自己的系统主题。', '2016-12-07 09:45:49', 6, 6),
(17, 22, 'html9', 'HTML没有1.0版本是因为当时有很多不同的版本。有些人认为蒂姆·伯纳斯-李的版本应该算初版，这个版本没有IMG元素。当时被称为HTML+的后续版的开发工作于1993年开始，最初是被设计成为“HTML的一个超集”。第一个正式规范为了和当时的各种HTML标准区分开来，使用了2.0作为其版本号。HTML+的发展继续下去，但是它从未成为标准。', '2016-12-07 09:46:16', 6, 6),
(18, 22, 'html10', 'HTML3.0规范是由当时刚成立的W3C于1995年3月提出，提供了很多新的特性，例如表格、文字绕排和复杂数学元素的显示。虽然它是被设计用来兼容2.0版本的，但是实现这个标准的工作在当时过于复杂，在草案于1995年9月过期时，标准开发也因为缺乏浏览器支持而中止了。3.1版从未被正式提出，而下一个被提出的版本是开发代号为Wilbur的HTML 3.2，去掉了大部分3.0中的新特性，但是加入了很多特定浏览器，例如Netscape和Mosaic的元素和属性。HTML对数学公式的支持最后成为另外一个标准MathML。', '2016-12-07 09:46:58', 6, 6),
(19, 22, 'html11', 'HTML 4.0同样也加入了很多特定浏览器的元素和属性，但是同时也开始“清理”这个标准，把一些元素和属性标记为过时，建议不再使用它们。HTML的未来和CSS结合会更好。', '2016-12-07 09:47:24', 6, 7),
(20, 22, 'html12', 'HTML 5草案的前身名为Web Applications 1.0。于2004年被WHATWG提出，于2007年被W3C接纳，并成立了新的HTML工作团队。在2008年1月22日，第一份正式草案发布。', '2016-12-07 09:47:46', 6, 6),
(21, 22, 'html13', 'XHTML1.0——发布于2000年1月26日，是W3C推荐标准，后来经过修订于2002年8月1日重新发布。', '2016-12-07 09:48:06', 6, 6),
(22, 22, 'html14', 'XHTML 1.1，于2001年5月31日发布，W3C推荐标准。', '2016-12-07 09:48:30', 6, 6),
(23, 22, 'html16', 'XHTML 5，从XHTML 1.x的更新版，基于HTML 5草案。', '2016-12-07 09:48:52', 6, 6),
(24, 22, 'html17', '在编辑超文本标记语言文件和使用有关标记符时有一些约定或默认的要求。', '2016-12-07 09:49:14', 6, 6),
(25, 22, 'html18', '文本标记语言源程序的文件扩展名默认使用htm（磁盘操作系统DOS限制的外语缩写为扩展名）或html（外语缩写为扩展名），以便于操作系统或程序辨认，除自定义的汉字扩展名。在使用文本编辑器时，注意修改扩展名。而常用的图像文件的扩展名为gif和jpg。', '2016-12-07 09:49:42', 6, 6),
(26, 22, 'html19', '超文本标记语言源程序为文本文件，其列宽可不受限制，即多个标记可写成一行，甚至整个文件可写成一行；若写成多行，浏览器一般忽略文件中的回车符（标记指定除外）；对文件中的空格通常也不按源程序中的效果显示。完整的空格可使用特殊符号（实体符）“&nbsp（注意此字母必须小写，方可空格）”表示非换行空格；表示文件路径时使用符号“/”分隔，文件名及路径描述可用双引号也可不用引号括起。', '2016-12-07 09:50:11', 6, 6),
(27, 22, 'html20', '标记符中的标记元素用尖括号括起来，带斜杠的元素表示该标记说明结束；大多数标记符必须成对使用，以表示作用的起始和结束；标记元素忽略大小写，即其作用相同，但完整的空格可使用特殊符号“&nbsp（注意此字母必须小写，方可空格）”；许多标记元素具有属性说明，可用参数对元素作进一步的限定，多个参数或属性项说明次序不限，其间用空格分隔即可；一个标记元素的内容可以写成多行。', '2016-12-07 09:51:10', 6, 6),
(28, 22, 'html21', '标记符号，包括尖括号、标记元素、属性项等必须使用半角的西文字符，而不能使用全角字符。', '2016-12-07 09:51:44', 6, 6),
(29, 22, 'html22', 'HTML注释由"<!--"号开始，由符号”-->“结束结束，例如<!--注释内容-->。注释内容可插入文本中任何位置。任何标记若在其最前插入惊叹号，即被标识为注释，不予显示。', '2016-12-07 09:52:15', 6, 8),
(30, 22, 'html23', '为了说明文档使用的超文本标记语言标准，所有超文本标记语言文档应该以“文件类型声明”（外语全称加缩写<!DOCTYPE>）开头，引用一个文件类型描述或者必要情况下自定义一个文件类型描述。举例来说', '2016-12-07 10:02:52', 6, 7),
(31, 22, 'html24', 'HTML 5由于没定义一个文档类型定义（外语缩写：DTD），只包含根元素的它所以如此简单。', '2016-12-07 10:03:22', 6, 6),
(32, 22, 'html25', '这个声明说明文档服从超文本标记语言 4.01的严格文件类型描述，这个标准是严格结构化的，使用层叠样式表（外语缩写：CSS）来做格式化。有时是否存在一个合适的文件类型描述会影响一个浏览器显示网页的方式。', '2016-12-07 10:03:55', 6, 6),
(33, 22, 'html26', '除了超文本标记语言 4.01的严格文件类型描述之外，超文本标记语言 4.01也提供“过渡”和“框架集”文件类型描述。', '2016-12-07 10:04:18', 6, 6),
(34, 22, 'html27', '每种HTML标记符在使用中可带有不同的属性项，用于描述该标记符说明的内容显示不同的效果。正文标记符中提供以下属性来改变文本的颜色及页面背景。', '2016-12-07 10:04:58', 6, 6),
(36, 22, 'html29', 'VLINK（外语全称：VisitedLINK）用于定义网页中已被访问过的超接链接字符的颜色，默认为紫红色', '2016-12-07 10:06:06', 6, 6),
(37, 22, 'html30', 'ALINK（中文全称：活动链接）用于定义被鼠标选中，但未使用时超链字符的颜色，默认为红色', '2016-12-07 10:06:31', 6, 6),
(38, 22, 'html31', '以上属性使用中，需要对颜色进行说明，在HTML中对颜色可使用3种方法说明颜色属性值，即直接颜色名称、16进制颜色代码、10进制RGB码', '2016-12-07 10:06:58', 6, 7),
(39, 22, 'html32', '直接颜色名称，可以在代码中直接写出颜色的英文名称。如<font color="red">我们</font>，在浏览器上显示时就为红色。', '2016-12-07 10:07:22', 6, 7),
(40, 22, 'html33', '16进制颜色代码，语法格式： #RRGGBB 。16进制颜色代码之前必须有一个“#”号，这种颜色代码是由三部分组成的，其中前两位代表红色，中间两位代表绿色，后两位代表蓝色。不同的取值代表不同的颜色，他们的取值范围是00--FF。如<font color="#FF0000">我们</font>，在浏览器上显示同样为红色。', '2016-12-07 10:07:46', 6, 6),
(41, 22, 'html34', '10进制RGB码，语法格式： RGB(RRR,GGG,BBB) 。在这种表示法中，后面三个参数分别是红色、绿色、蓝色，他们的取值范围是0--255。以上两种表达方式可以相互转换，标准是16进制与10进制的相互转换。如<font color="rgb(255,0,0)">我们</font>，在浏览器上显示字体为红色。', '2016-12-07 10:08:05', 6, 6),
(42, 22, 'html35', '使用图案代替背景颜色，可以使页面更生动、美观。', '2016-12-07 10:08:40', 6, 6),
(44, 22, 'html38', '可将图像文件“图像.gif”所表示的一幅图像作为页面的背景，若图像幅面不够大，将会将图像重复平铺在窗口中。', '2016-12-07 10:09:32', 6, 6),
(45, 22, 'html39', 'xmlns 属性在XHTML中是必需的，但在 HTML中不是。不过，即使XHTML文档中的 <html> 没有使用此属性，W3C 的验证器也不会报错。这是因为 "xmlns=百度" 是一个固定值，即使您没有包含它，此值也会被添加到 <html> 标签中。', '2016-12-07 10:10:07', 6, 7),
(46, 23, 'html好学吗?', 'html是标签类语言,是所有计算机语言里面最简单的了,应该很容易上手吧?', '2016-12-08 20:18:31', 7, 9),
(47, 23, '新人贴', '大家好! 我是新来的,希望大家多多指教,相互学习!!', '2016-12-08 20:55:58', 7, 8),
(48, 19, 'php', 'sdjflsdkk;fk;sldfsdfsdfd', '2016-12-09 19:11:01', 8, 8),
(49, 19, 'php教程1', 'PHP（外文名:PHP: Hypertext Preprocessor，中文名：“超文本预处理器”）是一种通用开源脚本语言。语法吸收了C语言、Java和Perl的特点，利于学习，使用广泛，主要适用于Web开发领域。PHP 独特的语法混合了C、Java、Perl以及PHP自创的语法。它可以比CGI或者Perl更快速地执行动态网页。用PHP做出的动态页面与其他的编程语言相比，PHP是将程序嵌入到HTML（标准通用标记语言下的一个应用）文档中去执行，执行效率比完全生成HTML标记的CGI要高许多；PHP还可以执行编译后代码，编译可以达到加密和优化代码运行，使代码运行更快。', '2016-12-12 09:24:57', 7, 2);

-- --------------------------------------------------------

--
-- 表的结构 `sansi_info`
--

CREATE TABLE `sansi_info` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `title` varchar(255) DEFAULT NULL COMMENT '网站标题',
  `keywords` varchar(255) DEFAULT NULL COMMENT '网站关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '网站描述'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站设置表';

-- --------------------------------------------------------

--
-- 表的结构 `sansi_manage`
--

CREATE TABLE `sansi_manage` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '管理员id',
  `name` varchar(32) NOT NULL COMMENT '管理员账号',
  `pw` varchar(32) NOT NULL COMMENT '管理员密码',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '管理员创建时间',
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '管理员权限1:普通管理员0:超级管理员'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员信息表';

--
-- 转存表中的数据 `sansi_manage`
--

INSERT INTO `sansi_manage` (`id`, `name`, `pw`, `create_time`, `level`) VALUES
(5, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2016-12-17 05:31:21', 1),
(3, 'root', 'e10adc3949ba59abbe56e057f20f883e', '2016-12-16 12:43:52', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sansi_members`
--

CREATE TABLE `sansi_members` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '会员id号',
  `name` varchar(30) NOT NULL COMMENT '会员登录账号',
  `pwd` varchar(32) NOT NULL COMMENT '会员登录密码',
  `photo` blob,
  `register_time` datetime NOT NULL COMMENT '注册时间',
  `last_time` datetime NOT NULL COMMENT '最后登录时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员信息表';

--
-- 转存表中的数据 `sansi_members`
--

INSERT INTO `sansi_members` (`id`, `name`, `pwd`, `photo`, `register_time`, `last_time`) VALUES
(7, '隐姓埋名', '670b14728ad9902aecba32e22fa4f6bd', 0x70686f746f2f323031362f31322f31342f3439393535353835313430616339636538383737363832353339372e6a7067, '2016-11-05 21:57:31', '0000-00-00 00:00:00'),
(8, '123', '670b14728ad9902aecba32e22fa4f6bd', '', '2016-11-06 13:08:01', '0000-00-00 00:00:00'),
(9, 'sdfsjkdfl', '670b14728ad9902aecba32e22fa4f6bd', '', '2016-11-06 13:16:13', '0000-00-00 00:00:00'),
(10, 'uiopuooi', '670b14728ad9902aecba32e22fa4f6bd', '', '2016-11-06 13:28:40', '0000-00-00 00:00:00'),
(6, '白芳芳', '670b14728ad9902aecba32e22fa4f6bd', 0x70686f746f2f323031362f31322f31342f3237303030353835313334616565396561383430303631343031302e6a7067, '2016-11-05 21:46:47', '0000-00-00 00:00:00'),
(14, 'www', '000000', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '隔壁老王', '000000', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '他二舅', '000000', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '他三舅', '000000', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '他四舅', '000000', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '他五舅', '000000', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `sansi_reply`
--

CREATE TABLE `sansi_reply` (
  `re_id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `content_id` int(10) UNSIGNED NOT NULL COMMENT '帖子的id',
  `quote_id` int(10) UNSIGNED NOT NULL COMMENT '回复的对象id',
  `recontent` varchar(5000) DEFAULT NULL COMMENT '回复内容',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '回复时间',
  `member_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帖子回复表';

--
-- 转存表中的数据 `sansi_reply`
--

INSERT INTO `sansi_reply` (`re_id`, `content_id`, `quote_id`, `recontent`, `time`, `member_id`) VALUES
(16, 1, 0, '说的真好!!', '2016-12-11 06:17:28', 6),
(17, 1, 0, '学习一下!!', '2016-12-11 06:18:16', 6),
(18, 1, 0, '这都是一些概念的东西了解一些就行了,不需要死记!', '2016-12-11 06:24:59', 7),
(19, 1, 0, '顶一下!!', '2016-12-11 07:05:01', 6),
(20, 1, 0, '很好!赞!!', '2016-12-11 07:06:33', 7),
(21, 1, 0, '""";斯柯达;看刷脸上课都是"', '2016-12-11 07:30:33', 7),
(22, 1, 0, '<div style="color:red;">说的不错<div>', '2016-12-11 09:26:48', 6),
(23, 1, 0, '围殴和若和乌尔欧欧 \r\n\r\n\r\nDOI石佛寺了都快放假了看手机', '2016-12-11 09:28:18', 6),
(24, 1, 22, '你这是发的什么啊?', '2016-12-11 11:38:27', 6),
(25, 1, 21, '额....无语了!!', '2016-12-11 12:38:59', 6),
(26, 1, 25, '什么无语了??', '2016-12-11 12:39:33', 6),
(27, 4, 0, '说的不错!', '2016-12-11 13:12:56', 6),
(28, 4, 27, '是的 很不错!!', '2016-12-11 13:13:23', 6);

-- --------------------------------------------------------

--
-- 表的结构 `sansi_son_admin`
--

CREATE TABLE `sansi_son_admin` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '子版块id',
  `father_id` int(10) UNSIGNED NOT NULL COMMENT '父板块外键',
  `son_name` varchar(50) NOT NULL COMMENT '子版块名称',
  `intro` varchar(300) NOT NULL COMMENT '子版块简介',
  `vip_id` int(10) UNSIGNED NOT NULL COMMENT '会员id',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='子板块';

--
-- 转存表中的数据 `sansi_son_admin`
--

INSERT INTO `sansi_son_admin` (`id`, `father_id`, `son_name`, `intro`, `vip_id`, `sort`) VALUES
(23, 33, 'html灌水区', 'html交流学习!!', 0, 0),
(22, 33, 'html视频教程', 'html教程让你,快速掌握html,写出漂亮的页面.', 0, 0),
(19, 32, 'php交流学习区', 'php学习与交流.', 0, 0),
(16, 29, 'java编程讨论区', 'java编程讨论区', 0, 1),
(21, 29, 'java视频教程', 'java教程让你快速掌握java编程语言!', 0, 0),
(20, 32, 'php视频教程', 'php视频教程,让您快速掌握php语言!', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sansi_user_admin`
--

CREATE TABLE `sansi_user_admin` (
  `id` int(11) NOT NULL COMMENT '板块id',
  `name` varchar(30) NOT NULL COMMENT '父板块名称',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `sansi_user_admin`
--

INSERT INTO `sansi_user_admin` (`id`, `name`, `sort`) VALUES
(29, 'java教程', 4),
(32, 'php教程', 0),
(33, 'html教程', 0),
(34, '军事资讯', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sansi_content`
--
ALTER TABLE `sansi_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sansi_info`
--
ALTER TABLE `sansi_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sansi_manage`
--
ALTER TABLE `sansi_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sansi_members`
--
ALTER TABLE `sansi_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sansi_reply`
--
ALTER TABLE `sansi_reply`
  ADD PRIMARY KEY (`re_id`);

--
-- Indexes for table `sansi_son_admin`
--
ALTER TABLE `sansi_son_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sansi_user_admin`
--
ALTER TABLE `sansi_user_admin`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sansi_content`
--
ALTER TABLE `sansi_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '帖子的id', AUTO_INCREMENT=50;
--
-- 使用表AUTO_INCREMENT `sansi_info`
--
ALTER TABLE `sansi_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id';
--
-- 使用表AUTO_INCREMENT `sansi_manage`
--
ALTER TABLE `sansi_manage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员id', AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `sansi_members`
--
ALTER TABLE `sansi_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '会员id号', AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `sansi_reply`
--
ALTER TABLE `sansi_reply`
  MODIFY `re_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=29;
--
-- 使用表AUTO_INCREMENT `sansi_son_admin`
--
ALTER TABLE `sansi_son_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '子版块id', AUTO_INCREMENT=24;
--
-- 使用表AUTO_INCREMENT `sansi_user_admin`
--
ALTER TABLE `sansi_user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '板块id', AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
