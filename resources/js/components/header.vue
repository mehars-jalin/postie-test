<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="jumbotron">
            <router-link class="navbar-brand" to="/list-scores">Instagram Best App</router-link>
            <router-link class="navbar-brand logout" to="/logout">Logout</router-link>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "top-header"
    }
</script>
<style>
    .logout{
        float: right
    }
</style>