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
        <input type="email" name="" id="email" class="form-control" placeholder="username" value="e.germanetto@vallauri.edu">
        <input type="password" name="" id="password" class="form-control" placeholder="password">   
        <input type="button" name="" id="" class="btn btn-primary mt-5" value="login" @click="login">
        <p class="mt-2">{{ rispostaLogin }}</p>
        <br>
        <h4>Sessione</h4>
        <input type="button" name="" id="" class="btn btn-primary mt-5" value="getSession" @click="getSession">
        <p class="mt-2">{{ session }}</p>
        <br>
        <input type="button" name="" id="" class="btn btn-primary mt-5" value="getInfoSession" @click="getInfoSession">

        


    </div>
</template>

<script>

export default {
    data() {
        return{
            message: 'Hello Vue.js!',
            risposta: '',
            rispostaLogin: '',
            session: '',
            csrfToken: '',
        }
    },
    async mounted() {
        await this.getSession();
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log('CSRF Token:', this.csrfToken);
        console.log('Sessione:', this.session);
        
    },
    methods: {
    myFunction() {
      alert("Hello! I am an alert box!");
    },
    async provaAPI() {

        let response = await (await fetch('/test')).text();

        this.risposta = response;
    },


    async login() {
        console.log('Login');
        let username = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        try {
            let response = await (await fetch('/login', {
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
        if (response.status === 'ok') {
            this.rispostaLogin = response;
            console.log('Login riuscito. ID Utente:', this.rispostaLogin.idUtente);
            this.createSession();
        } else {
            this.rispostaLogin = response;
            console.error('Errore durante il login:', this.rispostaLogin.error);
        }
        console.log('risposta: ', this.rispostaLogin.idUtente);

        } catch (error) {
            console.error('Errore durante il login', error);
        }
        
    },


    async createSession(){
        try{
            let response = await (await fetch('/createSession',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    type: 'Users',
                    id: this.rispostaLogin.idUtente
                }),
                credentials: 'include'
            
            })).text();

            this.session = response;
            console.log('Sessione creata:', response);
        }catch (error){
            console.error('Errore nel creare la sessione:', error);
        }

    },

    async getSession(){
        try{
            let response = await (await fetch('/getSession',{
                credentials: 'include'
            })).json();
            this.session = response.data;
            console.log('Sessione:', this.session);
            

        }catch{
            console.error('Errore nel recupero della sessione:', error);
        }
    },

    async getInfoSession(){
        try{
            let response = await (await fetch('/getSessionInfo',{
                credentials: 'include'
            })).json();
            console.log('Info Sessione:', response);
        }catch{
            console.error('Errore nel recupero delle info sessione:', error);
        }
    } 
    }
}
  

</script>