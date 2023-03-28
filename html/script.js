const { createApp } = Vue

  createApp({
    data() {
      return {
        comments: [],
        form:{ name:'', email:'', title:'', text:'' },
        error:{ name: null, email: null, title: null, text: null },
        backendUrl:'http://localhost:8089/api/',
        isSended: false,
      }
    },
    computed: {
      isValidEmail() {
        return /^[^@]+@\w+(\.\w+)+\w$/.test(this.form.email);
      },
      canSend()
      {
        return this.form.name.length > 0 && this.isValidEmail && this.form.title.length > 0 && this.form.text.length > 0;
      }
    },
    watch:{
      'form.name'(newValue){
        if(newValue.length === 0 && !this.isSended)
          this.error.name = true;
        else
          this.error.name = false;
        if(this.isSended == true && newValue.length > 0 )
        {
          this.isSended = false;
        }
      },
      'form.email'(newValue){
        if(!this.isValidEmail && !this.isSended)
          this.error.email = true;
        else
          this.error.email = false;
        if(this.isSended == true && this.isValidEmail == true)
        {
          this.isSended = false;
        }
      },
      'form.title'(newValue){
        if(newValue.length === 0 && !this.isSended)
          this.error.title = true;
        else
          this.error.title = false;
        if(this.isSended == true && newValue.length > 0 )
        {
          this.isSended = false;
        }
          
      },
      'form.text'(newValue){
        if(newValue.length === 0 && !this.isSended)
          this.error.text = true;
        else
          this.error.text = false;
      }
    },
    methods:{
      addComent(){
        axios.post(this.backendUrl+'comments',{...this.form})
        .then((res)=> {
            if(res.data.success) {
              this.comments.push(res.data.data);
              for(let i in this.form){
                this.form[i] = "";
                this.error[i] = false;
              }
              this.isSended = true;
            } else {
              alert('Что то пошло не так');
            }
          }
        ).catch(({response})=>{
          for(let i in response.data.data)
          {
            this.error[i] = response.data.data[i]
          }
        });
      }
    },
    mounted()
    {
      axios.get(this.backendUrl+'comments')
      .then((res)=>{
          if(res.data.success) {
            this.comments = res.data.data;
          }
          else {
            alert('Что то пошло не так');
          }
        }
      );
    }
  }).mount('#app');