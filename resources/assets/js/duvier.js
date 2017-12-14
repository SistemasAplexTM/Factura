const app = new Vue({
    el: '#duvier',
    methods:{
    	enviar(){
            axios.get('generarEvento')
            .then(response =>  {
                alert('El evento se generó');

            })
              .catch(error => {
                console.log(error);
            });
        }
    },
    mounted() {
        Echo.private('duvier')
            .listen('duvierEvent', (e) => {
                alert('El evento se recibió');
                console.log('El evento se recibió');
            });
    }
});
