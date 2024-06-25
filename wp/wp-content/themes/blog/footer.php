<?php
$var            = variables();
$set            = $var['setting_home'];
$assets         = $var['assets'];
$url            = $var['url'];
$policy_page_id = (int) get_option( 'wp_page_for_privacy_policy' );
$logo           = carbon_get_theme_option( 'logo' );
?>
</main>
<script>
    var admin_ajax = '<?php echo $var['admin_ajax']; ?>';
</script>
<?php wp_footer(); ?>
</body>

</html>