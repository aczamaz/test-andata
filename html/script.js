const { createApp } = Vue

  createApp({
    data() {
      return {
        comments: [],
        form:{
          name:'',
          email:'',
          title:'',
          text:''
        },
        error:{
          name: null,
          email: null,
          title: null,
          text: null
        },
        backendUrl:'http://localhost:8089/api/'
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
        console.log(newValue.length);
        if(newValue.length === 0)
          this.error.name = true;
        else
          this.error.name = false;
      },
      'form.email'(newValue){
        if(!this.isValidEmail)
          this.error.email = true;
        else
          this.error.email = false;
      },
      'form.title'(newValue){
        if(newValue.length === 0)
          this.error.title = true;
        else
          this.error.title = false;
          
      },
      'form.text'(newValue){
        if(newValue.length === 0)
          this.error.text = true;
        else
          this.error.text = false;
      }
    },
    methods:{
      addComent(){
        axios.post(this.backendUrl+'comments',{...this.form})
        .then((res)=>
          {
            if(res.data.success)
            {
              this.comments.push(res.data.data);
            }
            else
            {
              alert('Что то пошло не так');
            }
          }
        );
      }
    },
    mounted()
    {
      axios.get(this.backendUrl+'comments')
      .then(
        (res)=>{
          if(res.data.success)
          {
            this.comments = res.data.data;
          }
          else
          {
            alert('Что то пошло не так');
          }
        }
      );
    }
  }).mount('#app');