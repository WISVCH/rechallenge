<!-- Page footer -->
<footer class="page-footer">

	<?php
	get_template_part("parts/footer/partners");
	?>

	<div class="footer-top dotted-border">
		<div class="row">

			<!-- Twitter -->
			<section class="small-12 large-push-6 large-6 columns">
				<?php
				dynamic_sidebar("footer-right");
				?>
			</section>

			<!-- Contact information -->
			<section class="small-12 large-pull-6 large-6 columns">
				<?php
				dynamic_sidebar("footer-left");
				?>
			</section>

		</div>
	</div>

	<div class="footer-bottom">
		<div class="row column">
			<p class="text-center">Copyright &copy; W.I.S.V. 'Christiaan Huygens' <?php echo date('Y'); ?></p>
		</div>
	</div>

</footer>

<?php
// Login form
get_template_part("parts/misc/login-form");

// WordPress footer hooks
wp_footer();
?>

</body>
</html>