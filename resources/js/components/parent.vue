<template>
    <div id="main">
        <TopHeader/>
        <div class="content">
            <router-view :instagram_auth_url="instagram_auth_url"></router-view>
        </div>
    </div>
</template>

<script>

    import TopHeader from './Header'

    export default {
        name :'main-app',
        components : {TopHeader},
        props:['instagram_auth_url']
    }
</script>