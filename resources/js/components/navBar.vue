<style>
    @import url('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
</style>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Servizi</a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <ul class="navbar-nav my-2 my-lg-0" >
      <li v-if="session == null" class="nav-item active">
        <a class="nav-link" href="#">Login</a>
      </li>
      <li v-else class="nav-item active">
        <button class="nav-link" value="logout" @click="logout">logout</button>
      </li>
      
    </ul>
  </div>
</nav>
</template>

<script>

export default {
    data() {
        return{
            session: null,

        }
    },
    async mounted(){
      await this.getSession();
    },
    methods: {
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

      async logout(){
        try{
            let response = await (await fetch('/destroySession',{
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    type: 'Users'
                }),
                credentials: 'include'
            })).json();
            if(response.status == 'success'){
                this.session = null;
            }
        }catch{
            console.error('Errore nel logout:', error);
        }
      }

    }
}
  

</script>