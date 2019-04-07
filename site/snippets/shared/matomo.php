<?php if (option('isLive') === true) : ?>
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
		var u='<?= rtrim(option('sylvainjule.matomo.url'), '/') . '/' ?>';
		_paq.push(['setTrackerUrl', u+'matomo.php']);
  	_paq.push(['setSiteId', '<?= option('sylvainjule.matomo.id'); ?>']);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<?php endif ?>
