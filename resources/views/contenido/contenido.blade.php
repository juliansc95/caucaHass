        @extends('principal')
        @section('contenido')

        @if(Auth::check())
            @if(Auth::user()->idrol == 1)
            <template v-if="menu==0">
               <dashboard></dashboard>
            </template>

            <template v-if="menu==1">
               <finca></finca>
            </template>

            <template v-if="menu==2">
                <cultivo></cultivo>
            </template>

            <template v-if="menu==3">
                <productor></productor>
            </template>
            
            <template v-if="menu==4">
                <encuestafitosanitaria></encuestafitosanitaria>
            </template>

            <template v-if="menu==5">
                <venta></venta>
            </template>

            <template v-if="menu==13">
               <compra></compra>
            </template>

            <template v-if="menu==14">
               <ventaview></ventaview>
            </template>

            <template v-if="menu==15">
               <compraview></compraview>
            </template>

            <template v-if="menu==16">
               <proyeccion></proyeccion>
            </template>




            <template v-if="menu==6">
            <categoriamora></categoriamora>
            </template>

            <template v-if="menu==7">
                <user></user>
            </template>

            <template v-if="menu==8">
                <rol></rol>
            </template>

            <template v-if="menu==26">
                <backup></backup>
            </template>

            <template v-if="menu==9">
                <predio></predio>
            </template>

            <template v-if="menu==10">
               <aplicacionq></aplicacionq>
            </template>
            
          

            <template v-if="menu==12">
               <fertilizante></fertilizante>
            </template>

            

            

          
            <template v-if="menu==22">
               <enfermedad></enfermedad>
            </template>


           
            <template v-if="menu==17">
               <vocacion></vocacion>
            </template>



            <template v-if="menu==18">
               <cosecha></cosecha>
            </template>

            <template v-if="menu==19">
               <visita></visita>
            </template>

            <template v-if="menu==20">
               <gpx></gpx>
            </template>

            <template v-if="menu==21">
               <gmap></gmap>
            </template> 
            <template v-if="menu==25">
              <gpxzone></gpxzone> 
            </template>
            <template v-if="menu==23">
                <lugarventa></lugarventa>
            </template>
            <template v-if="menu==11">
                <fitosanitario></fitosanitario>
            </template>
            <template v-if="menu==27">
                <gastos></gastos>
            </template>
            <template v-if="menu==28">
                <adecuacion></adecuacion>
            </template>
            <template v-if="menu==29">
                <produccion></produccion>
            </template>
            <template v-if="menu==30">
                <resumen></resumen>
            </template>
            @elseif(Auth::user()->idrol == 2)
            <template v-if="menu==5">
                <venta></venta>
            </template>

            <template v-if="menu==13">
               <compra></compra>
            </template>

            <template v-if="menu==14">
               <ventaview></ventaview>
            </template>

            <template v-if="menu==15">
               <compraview></compraview>
            </template>



            @elseif(Auth::user()->idrol == 3)
            <template v-if="menu==1">
               <finca></finca>
            </template>

            <template v-if="menu==2">
                <cultivo></cultivo>
            </template>

            <template v-if="menu==3">
                <productor></productor>
            </template>
            
            <template v-if="menu==4">
                <encuestafitosanitaria></encuestafitosanitaria>
            </template>
            <template v-if="menu==16">
               <proyeccion></proyeccion>
            </template>
            <template v-if="menu==21">
               <gmap></gmap>
            </template> 
            <template v-if="menu==9">
                <predio></predio>
            </template>

            <template v-if="menu==10">
               <aplicacionq></aplicacionq>
            </template>
            
            <template v-if="menu==11">
                <fitosanitario></fitosanitario>
            </template>
          
            <template v-if="menu==12">
               <fertilizante></fertilizante>
            </template>
            @elseif(Auth::user()->idrol == 4)
            
            
            @elseif(Auth::user()->idrol == 5)
            <template v-if="menu==5">
            <ventacontador></ventacontador>
            </template>
            @else
            @endif
        @endif
    @endsection