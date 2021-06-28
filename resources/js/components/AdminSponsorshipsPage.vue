<template>

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <h2>Le tue sponsorizzazioni</h2>
                <thead class="table-light">
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1">Appartamento</th>
                        <th tabindex="0" rowspan="1" colspan="1">Status</th>
                        <th tabindex="0" rowspan="1" colspan="1">Data fine</th>
                        <th tabindex="0" rowspan="1" colspan="1">Prezzo</th>
                    </tr>
                </thead>

                <tbody>
                    <tr role="row" v-for="sponsored_apartment in sponsored_apartments" :key="sponsored_apartment.id">
                        <td class="text-left">{{sponsored_apartment.id}}</td>
                        <!-- <td class="text-right">attivo/non attivo</td>
                        <td class="text-right">{{sponsored_apartment.end_date}}</td>
                        <td class="text-right">{{sponsored_apartment.amount}}</td> -->
                    </tr>
                </tbody>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Metti in evidenza un appartamento</h2>
                <button><a href="/admin/payment">vai al pagamento</a></button>

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

