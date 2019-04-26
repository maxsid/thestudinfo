<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#news-carusel').jcarousel({
            vertical: true,
            scroll: 2
        });
    });
</script>

<div class="news_dvig">
   <h3>Новости</h3>
</div>
   <ul id="news-carusel" class="jcarousel-skin-ie7">

    <?php
	$news = new anyNews($my->group);
    for ($i = 0; $i < $news->getCount(); $i++)
    {

        $this_discription = $news->groupNews[$i]->description;
        $this_name = $news->groupNews[$i]->name;

        //Если столбец "text" определен, то добавляем ссылки на полную новость
        if ($news->groupNews[$i]->text != null){
            $this_discription .= '  <a href="../news/view.php?i='.$news->groupNews[$i]->id.'">Полностью... </a>';
            $this_name = '<a href="../news/view.php?i='.$news->groupNews[$i]->id.'">'.$this_name.'</a>';
        }


        print   '
	<li><div class="short-news">
		<div class="short-date">'.$news->groupNews[$i]->time.'<span>'.$news->groupNews[$i]->getDate().'</span><a class="favs" href="#"></a></div>
		<div class="short-content">
			<h1>'.$this_name.'</h1>
			'.$this_discription.'
		</div>
		<div class="clear"></div></div></li>';
    };
    if ($news->getCount() == 0) {
        print '
	<li><div class="short-news">
		<div class="short-date"><span></span><a class="favs" href="#"></a></div>
		<div class="short-content">
		    <br>
			<h1>Новостей нет</h1>
		</div>
		<div class="clear"></div></div></li>';
    }
    ?>
