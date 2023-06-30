<template>
    <div>
        <ol class="breadcrumb 2">
            <li><router-link to="/home"><i class="entypo-home"></i>Home</router-link></li>
            <li class="active"><strong>Pedidos</strong></li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="tile-stats tile-white tile-white-primary">
                            <div class="icon"><i class="entypo-basket"></i></div>
                            <div class="num">{{ totals.ordersToDay  }}</div>
                            <h3>Pedidos de hoy</h3>
                            <p>La suma del número de pedidos recibos Hoy.</p>
                        </div>   
                    </div>
                    <div class="col-sm-3">
                        <div class="tile-stats tile-white tile-white-primary">
                            <div class="icon"><i class="entypo-chart-area"></i></div>
                            <div class="num">$ {{ Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(totals.totalToDay) }}</div>
                            <h3>Total de hoy</h3>
                            <p>La suma del total de pedidos recibos Hoy.</p>
                        </div>   
                    </div>
                    <div class="col-sm-3">
                        <div class="tile-stats tile-white tile-white-primary">
                            <div class="icon"><i class="entypo-basket"></i></div>
                            <div class="num">{{ totals.ordersToMonth  }}</div>
                            <h3>Pedidos del mes</h3>
                            <p>La suma del número de pedidos recibos en el mes.</p>
                        </div>   
                    </div>
                    <div class="col-sm-3">
                        <div class="tile-stats tile-white tile-white-primary">
                            <div class="icon"><i class="entypo-chart-area"></i></div>
                            <div class="num">$ {{ Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(totals.totalToMonth) }}</div>
                            <h3>Total del mes</h3>
                            <p>La suma del total de pedidos recibos en el mes.</p>
                        </div>   
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div id="toolbar">

                    <div class="row">

                        <div class="col-md-3">
                            <a type="button" class="btn btn-primary btn-sm" href="./api/admin/ordersExport" download="ventas.xlsx" ><i class="fa fa-file"></i> Exportar</a>
                        </div>

                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Filtrar por cliente</label>
                                <div class="col-sm-7">
                                    <v-select id="filed-1" v-model="customer_id" :options="courses" label="name" index="id"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Filtrar por productos</label>
                                <div class="col-sm-7">
                                    <v-select id="filed-1" v-model="product_id" :options="courses" label="name" index="id"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <input-form name="start" type="date" text="Desde" :data.sync="start"></input-form>
                                </div>
                                <div class="col-md-5">
                                    <input-form name="end" type="date" text="Hasta" :data.sync="end"></input-form>
                                </div>
                                <div class="form-group-append">
                                    <button class="btn btn-outline-secondary" type="button" @click="filterContent()">Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <table id="pedidos"></table>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    export default {
        data(){
            return {
                orders:[],

                totals:{
                    totalToDay: 0,
                    totalToMonth: 0,
                    ordersToDay: 0,
                    ordersToMonth: 0
                },
                start: null,
                end: null,
                customer_id:null,
                product_id:null,
                
                courses:[]
            }
        },
        methods:{
            mounthTable(){
                jQuery('#pedidos').bootstrapTable({
                    columns: [
                        {
                            field:"check",
                            checkbox:true,
                            align: 'center'
                        },
                        {
                            field: 'id',
                            title: '#',
                            sortable:true,
                            switchable:true,
                            align: 'center'
                        },
                        {
                            field: 'created_at',
                            title: 'Fecha',
                            sortable:true,
                            switchable:true,
                            align: 'center'
                        },                    
                        {
                            field: 'status',
                            title: 'Estatus',
                            sortable:true,
                            switchable:true,
                            align: 'center'
                        },
                        {
                            field: 'user.name',
                            title: 'Cliente',
                            sortable:true,
                            align: 'center'
                        },

                        {
                            field: 'user.email',
                            title: 'Email del cliente',
                            sortable:true,
                            align: 'center'
                        },

                        {
                            field: 'subtotal',
                            title: 'Subtotal',
                            sortable:true,
                            switchable:true,
                            align: 'center'
                        },
                        {
                            field: 'total',
                            title: 'Total',
                            sortable:true,
                            switchable:true,
                            align: 'center'
                        },
                        
                    ],
                    //Boton de refrescar
                    showRefresh:true,

                });

                jQuery('#pedidos').on('refresh.bs.table',()=>{
                    //this.getContent();
                });

                jQuery('#pedidos').on('click-row.bs.table',(row,data)=>{
                    this.$router.push('/orders/detail/'+data.id);
                });

                //this.getContent();

            },

            getContent(){
                axios.get(tools.url("/api/admin/orders")).then((response)=>{
                    this.totals = response.data.totals;
                    this.orders = response.data.orders;
                    jQuery('#pedidos').bootstrapTable('removeAll');
                    jQuery('#pedidos').bootstrapTable('append',response.data.orders);
                }).catch((error)=>{
                    this.$parent.handleErrors(error);
                });
            },
            filterContent(){
                this.$parent.inPetition = true;
                axios.post(tools.url("/api/admin/ordersFilter"), { desde: this.start, hasta: this.end,}).then((response)=>{
                    this.totals = response.data.totals;
                    this.orders = response.data.orders;
                    jQuery('#pedidos').bootstrapTable('removeAll');
                    jQuery('#pedidos').bootstrapTable('append',response.data.orders);
                    

                }).catch((error)=>{
                    this.$parent.handleErrors(error);

                });
            },

        },
        mounted() {
            this.mounthTable();
        }
    }
</script>
