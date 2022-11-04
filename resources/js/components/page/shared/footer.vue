<template>
	<footer id="footer">
		<div class="container h-100">
			<div class="row h-100 align-items-center text-center">
				<div class="col-md-3">
					<router-link class="logo" to="/" tag="img" src="public/images/logo.png"></router-link>
				</div>
				<div class="col-md-6">
					© 2018 Sustam
				</div>
				<div class="col-md-3">
					<div class="row redes">
						<div class="col-md-4">
							<i class="fab fa-facebook-f red facebook"></i>
						</div>
						<div class="col-md-4">
							<i class="fab fa-twitter red twitter"></i>
						</div>
						<div class="col-md-4">
							<i class="fab fa-youtube red youtube"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</footer>
</template>

<script type="text/javascript">
	export default {
        mounted() {
            console.log('Footer mounted.');
        }
    }
</script>