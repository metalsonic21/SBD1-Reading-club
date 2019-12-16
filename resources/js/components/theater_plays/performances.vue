<template>
</template>

<script>
    export default {
        data(){
            return{
                        link1:'',
                        link2:'',
            }
        },
        created() {
            let path = window.location.pathname;
            let iclub = path.indexOf("/",0)+1;
            let fclub = path.indexOf('/',iclub);
            this.link1 = parseInt(path.substring(iclub,fclub),10);
            let fobra = path.indexOf('/',fclub+1);
            this.link2 = parseInt(path.substring(fclub+1,fobra),10);      
            console.log(this.link1);
            console.log(this.link2); 
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
