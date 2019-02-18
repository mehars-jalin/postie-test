<template>
        <div>
                <div v-if="loading" class="loader">
                        Loading.....
                </div>
                <ul>
                        <li v-for="image in images" v-text="image.total_points"></li>
                </ul>
        </div>
</template>

<script>
    export default {
        name: "list_scores",
        props:  ['resource','loading'],
        created(){
                this.getImages();
              //  this.startLoader();
        },
        data() {
            return {
                images: []
            };
        },
        methods: {

                getImages(){
                    console.log('This is token' + localStorage.getItem('access_token'));
                    axios.get('/postie-test/public/api/login-success/'+localStorage.getItem('access_token'))
                        .then(response => this.images = response.data)
                        .catch(error => {});
                }
        }
    }
</script>
<style>
        .loader {
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #3498db;
                width: 120px;
                height: 120px;
                -webkit-animation: spin 2s linear infinite; /* Safari */
                animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
        }
</style>