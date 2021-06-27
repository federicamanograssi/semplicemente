<template>

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <h2>Le tue sponsorizzazioni</h2>
                <thead class="table-light">
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1">Appartamento</th>
                        <th tabindex="0" rowspan="1" colspan="1">Status sponsorizzazione</th>
                        <th tabindex="0" rowspan="1" colspan="1">Data fine</th>
                        <th tabindex="0" rowspan="1" colspan="1">Prezzo</th>
                    </tr>
                </thead>

                <tbody>
                    <tr role="row">
                        <td class="text-left">nome appartamento</td>
                        <td class="text-right">attivo/non attivo</td>
                        <td class="text-right">data fine </td>
                        <td class="text-right">quanto pagao</td>
                    </tr>
                </tbody>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Metti in evidenza un appartamento</h2>

                <!-- INIZIO FORM PER SALVARE SPONSORIZZATA -->

                <form action="">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <select class="custom-select custom-select-lg mb-3" v-model="selectedApartment">
                                <option value="-1">Seleziona un appartamento</option>
                                <option 
                                    v-for="apartment in apartments" :key="apartment.id" :value="apartment.title">{{apartment.title}}</option>
                                
                            </select>

                            <h2> Scegli la sponsorizzazione</h2>
                            <!-- seleziona sponsorizzazione da attribuire -->
                            <div class="form-check"
                            v-for="sponsorship in sponsorships" :key="sponsorship.id">
                                <input class="form-check-input" type="radio" 
                                :name="sponsorship.name" :value="sponsorship.name" v-model="selectedSponsorship">
                                <label class="form-check-label" :for="sponsorship.name">{{ sponsorship.name }}</label> 
                            </div>

                        </div>
                        <div class="col-xs-12 col-md-6">
                            Metodo di Pagamento
                            <button><a href="/admin/payment">vai al pagamento</a></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        props: ['apartments','sponsorships'],
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

