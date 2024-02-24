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
        <br>
        <h4>Prova login</h4>
        <input type="email" name="" id="email" class="form-control" placeholder="username">
        <input type="password" name="" id="password" class="form-control" placeholder="password">   
        <input type="button" name="" id="" class="btn btn-primary mt-5" value="login" @click="login">
        <p class="mt-2">{{ rispostaLogin }}</p>
        


    </div>
</template>

<script>

export default {
    data() {
        return{
            message: 'Hello Vue.js!',
            risposta: '',
            rispostaLogin: '',
        }
    },
    mounted() {
    },
    methods: {
    myFunction() {
      alert("Hello! I am an alert box!");
    },
    async provaAPI() {

        let response = await (await fetch('http://localhost:8000/test')).text();

        this.risposta = response;
    },


    async login() {
        
        let username = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        try {
            let response = await (await fetch('http://localhost:8000/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken
            },
            body: JSON.stringify({
                email: username,
                password: password
            })
        })).json();

        this.rispostaLogin = response;
        } catch (error) {
            console.error('Errore durante il login', error);
        }
        
    }
  }
}
  

</script>