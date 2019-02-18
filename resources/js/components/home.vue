<template>
    <div class="container">
        <img src="https://image.freepik.com/free-vector/instagram-icon_1057-2227.jpg" alt="instagram-image" height="300px" width="300px">
        <div class="links">
            <button class="btn" @click="sendToInstagram()">Fetch your Instagram pictures</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
        props:['instagram_auth_url'],
        methods:{
            sendToInstagram: function(){
                window.location =   this.instagram_auth_url;
            }
        }
    }
</script>