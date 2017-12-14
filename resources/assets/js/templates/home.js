const app = new Vue({
    el: '#home',
    data: {
    	product: [],
    },
    watch:{
        message(){
            Echo.private('change')
                .whisper('typing', {
                    name: this.response
                });
        }
    },
    methods:{
    	get(){
            axios.get('get')
            .then(response =>  {
                this.product  = response;
            })
              .catch(error => {
                console.log(error);
            });
        },
        getTime(){
            let time = new Date();
            return time.getHours()+':'+time.getMinutes();
        },
        changeState(id){
            axios.post('update', {
                id: id
            })
            .then(response =>  {
                this.get();
                var $toastContent = $('<span>Petición denegada</span>');
                // var $toastContent = $('<span>Petición denegada</span>').add($('<button class="btn-flat toast-action">Deshacer</button>'));
                Materialize.toast($toastContent, 10000);
            })
              .catch(error => {
                console.log(error);
            });
        },
        updatePrice(product){
            axios.post('updatePrice', {
                id: product.id,
                product_id: product.product_id,
                price_new: product.precio_sugerido
            })
            .then(response =>  {
                this.get();
                var $toastContent = $('<span>Petición aceptada</span>');
                Materialize.toast($toastContent, 10000);
            })
              .catch(error => {
                console.log(error);
            });
        },
        undoDenied(id){
            axios.post('undoDenied/'+ id)
            .then(response =>  {
                this.get();
                var $toastContent = $('<span>Deshacer exitoso.</span>');
                Materialize.toast($toastContent, 10000);
            })
              .catch(error => {
                console.log(error);
            });
        }
    },
    mounted() {
        this.get();
        Echo.private('change')
            .listen('ChangeEvent', (e) => {
                if (e.response == 'nueva') {
                    Push.create("Nueva petición", {
                        body: "Tiene una nueva solicitud para cambio de precio.",
                        icon: 'img/xplod.png',
                        timeout: 4000,
                        onClick: function () {
                            window.focus();
                            this.close();
                        }
                    });
                }else if(e.response == 'denegada'){
                    Push.create("Petición denegada", {
                        body: "La petición para cambio de precio fue denegada.",
                        icon: 'img/xplod.png',
                        timeout: 4000,
                        onClick: function () {
                            window.focus();
                            this.close();
                        }
                    });
                }else if(e.response == 'aceptada'){
                    Push.create("Petición aceptada", {
                        body: "La petición para cambio de precio fue aceptada.",
                        icon: 'img/xplod.png',
                        timeout: 4000,
                        onClick: function () {
                            window.focus();
                            this.close();
                        }
                    });
                }
                var $toastContent = $('<span>Petición '+e.response+'</span>');
                // var $toastContent = $('<span>'+e.response+'</span>');
                Materialize.toast($toastContent, 10000);
                this.get();
            });
    }
});
