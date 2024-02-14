<!--importare boostrap-->
<style>
    @import url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
</style>


<template>
    <div class="container">
        <h1>{{ message }}</h1>
        <input type="button" name="" id="" class="btn btn-primary mt-5" value="ciao" @click="provaAPI">
        <br>
        <input type="button" name="" id="" class="btn btn-primary mt-5" value="prova" @click="myFunction">
        <br>
        <p class="mt-2">{{ risposta }}</p>
        


    </div>
</template>

<script>

export default {
    data() {
        return{
            message: 'Hello Vue.js!',
            risposta: ''

        }
    },
    methods: {
    myFunction() {
      alert("Hello! I am an alert box!");
    },
    async provaAPI() {

        let response = await (await fetch('http://localhost:8000/test')).text();

        this.risposta = response;
    }
  }
}
  

</script>