<?php
/**
 * links
 *
 * @package custom
 */
  $this->need('header.php'); 
?>
<!-- 友链部分 -->
<div class="blank"></div>
<div class="headertop"></div>
<?php 
    $bgImgUrl = '';
    if ( $this->fields->radioPostImg != 'none' && $this->fields->radioPostImg != null ) {
        switch ( $this->fields->radioPostImg ) {
        case 'custom':
            $bgImgUrl = $this->fields->thumbnail;
            break;
        case 'random':
            $bgImgUrl = theurl.'images/postbg/'.mt_rand(1,3).'.jpg';
            break;
        }
        echo('
            <div class="pattern-center">
                <div class="pattern-attachment-img" style="background-image: url('.$bgImgUrl.')"></div>
                    <header class="pattern-header">
                <h1 class="entry-title">'.$this->title.'</h1>
            </header>
            </div>
        ');
    } else {
        echo('<style> @media (max-width: 860px){#content {margin-top: 30px;}} </style>');
    }
?>
<!-- 透明导航栏后调整间距 -->
<!-- 透明导航栏后调整间距 -->
<?php if (strlen($bgImgUrl) <= 4 && !empty($this->options->menu) && in_array('transparent', $this->options->menu) ): ?>
<style>
  .site-content {
    padding: 80px 0 0;
  }
  @media (max-width: 860px){
    .site-content {
    padding: 50px 0 0;
  }
  }
</style>
<?php endif ?>
<div id="content" class="site-content">
	<span class="linkss-title"><?php $this->title() ?></span>
	<article class="hentry">
		<div class="entry-content">
		  <?php if( !$this->content && !class_exists('Links_Plugin')) {
			  echo'
				<div class="nodata">
				    <img src="https://blog.zixu.site/usr/themes/Akina/images/warn.png">
				    <div class="nodataText">
					    <p>没有相关的数据！</p>
					    <p>请在后台编写友链html或者安装<a href="https://github.com/Zisbusy/Akina-for-Typecho/tree/master/%E5%8F%AF%E9%80%89%E6%8F%92%E4%BB%B6" target="_blank" rel="nofollow noopener noreferrer">插件</a>
					    </p>
				    </div>
				</div>
			  ';
			} else {
				$pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
				$replacement = '<a href="$1" alt="'.$this->title.'" title="点击放大图片"><img class="aligncenter" src="$1" title="'.$this->title.'"></a></div>';
				echo preg_replace($pattern, $replacement, $this->content);
				if(class_exists('Links_Plugin')){
            echo '
            <br>
            <div class="links">
              <ul class="link-items fontSmooth">
            ';
				    $rules ='
            <li class="link-item">
              <a class="link-item-inner effect-apollo" href="{url}" title="{name}" target="_blank" >
                <span class="sitename">{name}</span>
                <div class="linkdes">{title}</div>
              </a>
            </li>';
					 Links_Plugin::output($pattern=$rules, $links_num=0, $sort=NULL);
           echo '
           </div>
            </ul>
           ';
				};
			}?>
		</div>
	</article>
</div>
</div>
</section>
<?php $this->need('footer.php'); ?>
