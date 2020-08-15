<template>
    <div>
        <input v-model="username" id="username" type="text" class="form-control" name="username" required @keyup="checkUsername" >    
        <span>{{ responseMessage }}</span>
    </div>
</template>
<script>
export default {   
 data() {
    return {
        username: '',
        isAvailable: 0,
        responseMessage: ''
    }
  },
  methods:{
    checkUsername(){
        var username=this.username.trim();
        if(username)
        {
          axios.get('/username',
              { params: { username:username }
          })
            .then( (response)=>{ 
              if(response.data)               
                this.responseMessage='Username not available !!';
              else
                this.responseMessage='Username available !!';
            })
            .catch(function (error) {
              console.log(error);
            });
        }
        else{
          this.responseMessage='';
        }
        
    }
  }
}
</script>