<template>
    <div>
        <nav>
            <div class="container">
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li>
                            <router-link :to="{ name: 'home' }">Início</router-link>
                        </li>
                    </ul>
                    <ul id="nav-mobile2" class="right">
                        <li v-if="!this.$store.state.isLoggedIn">
                            <router-link :to="{ name: 'login' }">Login</router-link>
                        </li>
 
                        <li v-if="!this.$store.state.isLoggedIn">
                            <router-link :to="{ name: 'register' }">Registro</router-link>
                        </li>
                         <li v-if="this.$store.state.isLoggedIn">
                            <router-link :to="{ name: 'lista' }">Tarefa</router-link>
                        </li>
                        <li v-if="this.$store.state.isLoggedIn">
                            <a href="#"  @click="logout()">Fechar sessão</a>
                        </li>
                       
                        
                    </ul>
                </div>
            </div>
        </nav>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
     
    </div>
</template>
<script>
export default {

   methods: {
     logout(evt) {
       if(confirm("Deseja fechar a sessão?")) {
         axios.get('api/auth/logout').then(response => {
          localStorage.removeItem('auth_token');
          delete axios.defaults.headers.common['Authorization'];
          this.$router.go('/login');
        })
        .catch(error => {
          localStorage.removeItem('auth_token');
          delete axios.defaults.headers.common['Authorization'];
          this.$router.go('/login');
        });       
       }
     }
   }
}
</script>