<template>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="tab-title">Metti in evidenza un appartamento</h1>
                <button class="btn btn-warning btn-lg"><a href="/admin/payment">Sponsorizza</a></button>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Le tue sponsorizzazioni</h2>
                <p>Qui puoi visualizzare tutte le tue sponsorizzazioni </p>

                <table class="table table-borderless">
                    <thead>
                        <tr role="row">
                            <th scope="col">Appartamento</th>
                            <th scope="col">Inizio</th>
                            <th scope="col">Fine</th>
                            <!-- <th scope="col">Attivo</th> -->
                            <th scope="col">Spesa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sponsored_apartment in sponsored_apartments" :key="sponsored_apartment.id">
                            <td class="text-left">{{sponsored_apartment.id}}</td>
                            <td class="text-left">{{sponsored_apartment.start_date}}</td>
                            <td class="text-left">{{sponsored_apartment.end_date}}</td>
                            <!-- <td class="text-left">SI/NO</td> -->
                            <td class="text-left">{{sponsored_apartment.amount}} €</td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <h2>Le tue transazioni</h2>
                <p>Qui puoi visualizzare tutte le tue transazioni</p>

                <table class="table table-borderless">
                    <thead>
                        <tr role="row">
                            <th scope="col">Appartamento</th>
                            <th scope="col">Data</th>
                            <th scope="col">Status</th>
                            <th scope="col">Importo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sponsored_apartment in sponsored_apartments" :key="sponsored_apartment.id">
                            <td class="text-left">{{sponsored_apartment.id}}</td>
                            <td class="text-left">{{sponsored_apartment.start_date}}</td>
                            <td class="text-left">{{sponsored_apartment.status}}</td>
                            <td class="text-left">{{sponsored_apartment.amount}} €</td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        props: ['apartments','sponsored_apartments','sponsorships'],
        mounted(){
            this.filterApartments();
        },

        data:function(){
            return {
                filteredApartments:[],
                selectedApartment:'-1',
                selectedSponsorship:'',
            };
        },
        methods: {
            filterApartments(){
                axios
                .get('http://127.0.0.1:8000/api/getUserSponsoredAptList')
                .then((filteredApartments)=>{
                    console.log(filteredApartments.data.results);
                })
            }
        }
    }

</script>
<style scoped>
    /* table{
        background-color: #d8af7f;
        border-radius: .25rem;
        width: 100%;
        overflow-x: auto;
    }
    thead{
        background-color: rgba(0,0,0,.03);
        font-size: 1.7rem;
    }
    th,td{
        padding:10px 20px;
    }
    @media (max-width: 768px){
        table{
            display: block;
        }
    } */
</style>

