<template>
    <header id="header">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-2 align-self-center logo">
                    <router-link to="/" tag="img" src="public/images/logo.png"></router-link>
                </div>
                <div class="col-md-6 offset-md-2 align-self-center menu">
                    <nav class="navbar navbar-expand">
                        <ul class="navbar-nav">
                            <router-link class="nav-link" to="/" tag="li" v-bind:class="{ active : $router.path=='/' }">Inicio</router-link>
                            <router-link class="nav-link" to="/instalation" tag="li">Instalacion</router-link>
                            <router-link class="nav-link" to="/backend" tag="li">backend</router-link>
                            <router-link class="nav-link" to="/frontend" tag="li">Frontend</router-link>
                            <router-link class="nav-link gray" to="/tutorials" tag="li">Tutoriales</router-link>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</template>

<script type="text/javascript">
	export default {
        mounted() {
            console.log('Header mounted.');
        }
    }
</script>