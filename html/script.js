const { createApp } = Vue

  createApp({
    data() {
      return {
        comments: [
            {
                id:1,
                name:'name1',
                email:'email@email.com',
                title:'title',
                text:'text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text ',
                date: Date("h-i-s").toString()
            },
            {
                id:2,
                name:'name2',
                email:'emai2@email.com',
                title:'title2',
                text:'text text text test test text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text ',
                date: Date("h-i-s").toString()
            },
            {
                id:2,
                name:'name3',
                email:'emai3@email.com',
                title:'title3',
                text:'text text text test test text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text text ',
                date: Date("h-i-s").toString()
            },
        ],
        form:{
          name:'',
          email:'',
          title:'',
          text:''
        },
        error:{
          name: false,
          email: false,
          title: false,
          text: false
        }
      }
    },
    methods:{
      addComent(){
        this.comments.push(this.form);
      }
    }
  }).mount('#app');