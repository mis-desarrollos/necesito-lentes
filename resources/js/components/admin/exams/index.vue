<template>
    <div>
      <ol class="breadcrumb 2">
              <li><router-link to="/home"><i class="entypo-home"></i>Home</router-link></li>
              <li class="active"><strong>Examanes de la vista</strong></li>
          </ol>
          <h2 class="margin-bottom">Examanes de la vista</h2>
  
          <div class="row">
              <div class="col-md-12">
                  
                  <button class="btn btn-success btn-sm" @click="addnewrow"><i class="fa fa-plus"></i> Nuevo</button>
                  <br><br>

                    <div class="form-group" v-if="$root.user.roles[0]['name'] == 'administrador'">
                          <label for="row_email" class="col-sm-3 control-label">Filtrar por optica:</label>   
                          <div class="col-sm-7">
                             <v-select v-model="filter.users_id_opticians" :options="opticiansOpcs" label="name" index="id" />
                          </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-3"></div>
                          <div class="col-sm-2">
                            <label >Todos: </label>   
                             <input v-model="filter.status" type="radio" style="transform:scale(1.5)" value="all" name="filter_type">
                          </div>
                          <div class="col-sm-2">
                            <label >Pendientes: </label>  
                             <input v-model="filter.status" type="radio" style="transform:scale(1.5)" value="Pendiente" name="filter_type">
                          </div>
                          <div class="col-sm-2">
                            <label >Finalizado: </label>  
                             <input v-model="filter.status" type="radio" style="transform:scale(1.5)" value="Finalizado" name="filter_type">
                          </div>
                    </div>
                    <br><br>

                 <!--  <button class="btn btn-danger btn-sm" @click="deleteRow()"><i class="fa fa-trash"></i> Borrar</button> -->
  
                  <FullCalendar :options="calendarOptions" />
  
              </div>
          </div>
          <sweet-modal ref="addOrderModal">
              <form role="form" class="form-horizontal" @submit.prevent="newRow($event.target)">
  
                  
                <div class="form-group">
                      <label class="col-sm-3 control-label">Cliente:</label>
                      <div class="col-sm-7">
                          <v-select v-model="orderForm.users_id" :options="usersOpcs" label="name" index="id" />
                      </div>
                  </div>    
                  
                  <input-form name="customer_phone" text="Telefono" :data.sync="orderForm.phone" ></input-form>
                  <input-form name="customer_email" text="Email" :data.sync="orderForm.email" ></input-form>
  
                  <input-form type="date" name="day_reservation" text="Fecha" :data.sync="orderForm.date" ></input-form>
  
                  <input-form type="time" name="time_start" text="Hora" :data.sync="orderForm.hour" ></input-form>
  
                 

                  <div class="form-group" v-if="$root.user.roles[0]['name'] == 'administrador'">
                      <label class="col-sm-3 control-label">Optica:</label>
                      <div class="col-sm-7">
                          <v-select v-model="orderForm.users_id_optician" :options="opticiansOpcs" label="name" index="id" />
                      </div>
                  </div>    

                   

                  <text-form  name="comments" text="Comentarios" :data.sync="orderForm.comments" ></text-form>
                    <hr>
                  <div class="form-group" v-if="$root.user.roles[0]['name'] == 'optica' && orderForm.id != null">
                      <label class="col-sm-3 control-label">Estatus:</label>
                      <div class="col-sm-7">
                          <v-select v-model="orderForm.status" :options="[{'id':'Pendiente'},{'id':'Finalizado'},{'id':'Cancelado'}]" label="id" index="id" />
                      </div>
                  </div>   
                  <div class="form-group">
                      <div class="col-sm-12">
                          <button type="button" class="btn btn-danger pull-left" @click="deleteOrder()"><i class="fa fa-trash"></i> Borrar</button>
                          <button type="submit" class="btn btn-success pull-right"><i class="far fa-save"></i> Guardar</button> 
                          <button type="button" class="btn btn-default pull-right" @click="$refs.addOrderModal.close()">Cancelar</button>			
                      </div>
                  </div>
              </form>	
          </sweet-modal>
      </div>
  </template>
  <script type="text/javascript">
  import FullCalendar from '@fullcalendar/vue'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import esLocale from '@fullcalendar/core/locales/es';
  
        export default {
        components: {
              FullCalendar,
        },
       data(){
          return {
            eventsAll:[],
              orderForm:{

              },
              calendarOptions: {
          
                headerToolbar: {
                    start: 'dayGridMonth,dayGridWeek,dayGridDay',
                    center: 'title',
                    end: 'prev,next'
                },

                editable: true,
                selectable: true,
                selectMirror: true,
                eventClick: this.handleEventClick,
    
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                events: [],
                locale:esLocale,
            },
                fieldsOpcs:[],
                statusOpcs:[
                    {id:'Agendada'},
                    {id:'Cancelada'}
                ],
                opticiansOpcs:[],
                usersOpcs:[],
                filter:{
                    users_id_opticians:null,
                    status:'all',
                }
          }
      },
      watch:{
        filter: {
            handler(val){
                var newdata = [];
                //filtro de optica
                if (val.users_id_opticians != null) {
                    for (let x = 0; x < this.eventsAll.length; x++) {
                        if (this.eventsAll[x]['users_id_optician'] == val.users_id_opticians) {
                            newdata.push(this.eventsAll[x]);
                        };
                        
                    }
                }
                else{
                    newdata = this.eventsAll;
                }

                var newdatados = [];
                if (val.status != 'all') {
                    for (let x = 0; x < newdata.length; x++) {
                        if (newdata[x]['status'] == val.status) {
                            newdatados.push(newdata[x]);
                        };
                        
                    }
                }
                else{
                    newdatados = newdata;
                }


                this.calendarOptions.events = newdatados;

            },
            deep: true
        }
  
      },
      methods:{
         
          getRows(){
            this.$parent.inPetition=true;
            axios.get(tools.url("/api/admin/exams")).then((response)=>{
                this.eventsAll = response.data;
                this.calendarOptions.events = response.data;
                
                this.$parent.inPetition=false;
              }).catch((error)=>{
                  this.$parent.handleErrors(error);
                  this.$parent.inPetition=false;
              });
          },
  
          deleteRow:function(){
            var rows=jQuery('#news').bootstrapTable('getSelections');
            if(rows.length==0){
              return false;
            }
            alertify.confirm("Alerta!","¿Seguro que deseas borrar "+rows.length+" registros?",()=>{
              this.$parent.inPetition=true;
              var params={};
              params.ids=jQuery.map(rows,(row)=>{
                return row.id;
              });
  
              axios.delete(tools.url('/api/admin/blogs'),{data:params})
              .then((response)=>{
                this.$parent.showMessage(response.data.msg,"success");
                this.getNews();
                this.$parent.inPetition=false;
              })
              .catch((error)=>{
                this.$parent.handleErrors(error);
                    this.$parent.inPetition=false;
              });
            },
            ()=>{
            });
          },
          showEvent: function(arg) {
              console.log(arg);
            alert('date click! ' + arg.dateStr)
          },
  

  
          addnewrow(){
              this.orderForm = {
                  id:null,
                  name:null,
                  phone:null,
                  email:null,
  
                  date:null,
                  hour:null,
                  comments:null,
                  users_id_optician:null,
                  users_id:null
              };

              if(this.$root.user.roles[0]['name'] == 'optica'){
                this.orderForm.users_id_optician = this.$root.user.id;
              }
              this.$refs.addOrderModal.open();
          },
          newRow(form){				
              this.$parent.inPetition=true;
              this.$parent.validateAll(()=>{
  
  
                  if(this.orderForm.id){
                          axios.post(tools.url("/api/admin/exams/"+this.orderForm.id),this.orderForm)
                          .then((response)=>{
                              this.orderForm = {
                                id:null,
                                name:null,
                                phone:null,
                                email:null,
                
                                date:null,
                                hour:null,
                                comments:null,
                                users_id_optician:null,
                              };
                              this.$refs.addOrderModal.close();
                              this.$parent.showMessage("Registro modificado correctamente!","success");
                              this.$parent.inPetition=false;
                              this.getRows();
                          }).catch((error)=>{
                              this.$parent.handleErrors(error);
                              this.$parent.inPetition=false;
                          });
                  }
                  else{
                          axios.post(tools.url("/api/admin/exams"),this.orderForm)
                          .then((response)=>{
                              this.orderForm = {
                                id:null,
                                name:null,
                                phone:null,
                                email:null,
                
                                date:null,
                                hour:null,
                                comments:null,
                                opticians_id:null,    
                                users_id:null,
                              };
                              this.$refs.addOrderModal.close();
  
                              var news = response.data;
                              this.$parent.showMessage("Registro agregado correctamente!","success");
                              
                              this.$parent.inPetition=false;
                              this.getRows();
                          }).catch((error)=>{
                              this.$parent.handleErrors(error);
                              this.$parent.inPetition=false;
                          });
                  }
              },(e)=>{
                  console.log(e);
                  this.$parent.inPetition=false;
              });				
          },
          handleEventClick(clickInfo){
              var indx = null;
              for (var i = 0; i < this.calendarOptions.events.length; i++) {
                  if(this.calendarOptions.events[i].id == clickInfo.event.id){
                      indx = i;
                      break;
                  }
              }
                
                this.orderForm = this.calendarOptions.events[indx];
                this.$refs.addOrderModal.open();
          },
          deleteOrder(){
              this.$refs.addOrderModal.close();
              alertify.confirm("Alerta!","¿Seguro que desea eliminar este registro?",() => {
                  axios.delete(tools.url("/api/admin/exams/" + this.orderForm.id )).then(result => {
                      this.getRows();
                      this.$parent.showMessage(result.data.msg, "success");
                  }).catch(error => {
                      
                  });
              }, ()=>{});
          },
          getOpticiansOpcs(){
            axios.get(tools.url("/api/admin/opticians")).then((response)=>{
                this.opticiansOpcs = response.data;
            }).catch((error)=>{
            });
        },
    
        getUsersOpcs(){
            axios.get(tools.url("/api/admin/customersOpcs")).then((response)=>{
                this.usersOpcs = response.data;
            }).catch((error)=>{
            });
        },
        
  
  
      },
      mounted() {
            this.getOpticiansOpcs();
            this.getUsersOpcs();
            this.getRows(); 
      }
    }
  </script>
  <style type="text/css">
  
  </style>
  