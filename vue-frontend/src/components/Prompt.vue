<template>
  <div id="Prompt" :class="promptClass">
    <div id="overlay"></div>
    <div class="promptContainer">
      <v-card class="innerBox">
        <span id="x"
        @click="closePrompt"
        >X
        </span>
        <h2>{{title}}</h2>
        <img :src="img" alt="">
        <p>{{msg}}</p>
        <p>{{price}} &#163;</p>
        <div class="d-flex flex-wrap justify-center" style="width:80%; margin: 0 auto;">
          <v-btn 
          v-for="(extra, index) in this.itemExtras" :key="index" 
          class="mr-2 ml-2 mb-4"
          width="180px"
          style="
          margin:0;
          padding:0;
          "
          >
            <div class="checkbox-container">
              <input type="checkbox" :id="extra" :name="extra" v-model="selectedExtras[extra]">

              <label :for="extra" class="mr-2">
                {{extra}}
              </label>

            </div>
          </v-btn>
        </div>

        <v-btn 
          class="red white--text mb-5 mt-5"
          @click="addingToCart"
        >Add to cart
        </v-btn>

      </v-card>
    </div>
  </div>
</template>
<script>
export default {
  name:'Prompt',
  props: {
    msg: String,
    displayPrompt: String,
    title:String,
    img: String,
    price:String,
    extras:String
  },
  watch: {
    displayPrompt: function(){
      this.promptDisplay()
    },
    extras: function(){
      this.createSelectedExtras(); //this must happen first
      this.extraCheckboxMaker();
    }
  },
  data(){
    return {
      itemExtras:[],
      selectedExtras:[],
      promptClass:'none'
    }
  },
  methods:{
    promptDisplay(){ //prompt class affects the visibility of this entire component
      if(this.displayPrompt == 'false'){
        this.promptClass = 'none'; //therefore, display:none
      } else if(this.displayPrompt == 'true')
        this.promptClass = 'block'; //therefore, display:block
    },

    extraCheckboxMaker(){ 
    this.itemExtras = [];
      if(this.extras && this.extras.indexOf(',') != -1){ //if there is no ',' that  means there is only one extra
        this.itemExtras = this.extras.split(', ');
        console.log('extras')
        console.log(this.itemExtras)
      } else if(this.extras != "" && this.extras != null) { //if the prop is any of these, it means there are no extras
        this.itemExtras.push(this.extras)
        console.log(this.itemExtras)
      }
    },

    createSelectedExtras(){
      for(var i = 0; i < this.itemExtras.length; i++){
        this.selectedExtras[this.itemExtras[i]] = false;
      }
    },

    addingToCart(){
      var keys = Object.keys(this.selectedExtras);
      var chosenExtras = [];

      for(var i = 0; i < keys.length; i++){
        if(this.selectedExtras[keys[i]] === true){
          chosenExtras.push(keys[i])
        }
      }

      this.$emit("adding-to-cart",chosenExtras)
      this.selectedExtras = [];
    },

    closePrompt(){
      this.$emit("update-prompt")
      this.selectedExtras = [];
    }
  },
  mounted(){
    this.promptDisplay()
    console.log(this.selectedExtras)

    //adding item to cart with the enter key
    document.addEventListener("keydown",(e)=>{
      if((e.keyCode == '13' || e.which == '13') && this.displayPrompt == 'true'){ //adding an item on enter ONLY if displayPrompt is true
        this.addingToCart()
        this.$emit("update-prompt");
      }
    })

    //closing item prompt with esc key
    document.addEventListener("keydown",(e)=>{
      if(e.keyCode == 27 || e.which == 27){
         this.$emit("update-prompt")
         this.selectedExtras = [];
      }
    })
  }
}
</script>
<style lang="scss" scoped>
#overlay{
  background-color: rgba(102, 101, 101, 0.6);
  width:100%;
  height:100%;
  position: fixed;
  z-index: 9;
  top:0;
  left:0;
}
.promptContainer {
  width:100%;
  height:100%;
  position: fixed;
  left:0;
  top:0;
  z-index: 10;
  .innerBox {
    width:53%;
    margin:20px auto 0 auto;
    padding:30px;
    max-height:90%;
    overflow-y: scroll;
    img {
      width:65%;
      margin: 0 auto;
    }
    .checkbox-container {
      position:relative;
      input {
        position:absolute;
        left: 20px;
        top:10px;
      }
      label {
        display:inline-block;
        padding:10px 40px;
        width:180px;
        margin-left: 7px; 
      }
    }
  }
}


#x {
  padding:2px 10px;
  border-radius:50%;
  background-color: red;
  color:#fff;
  position:absolute;
  right:25px;
}

#x:hover {
  background-color:rgb(248, 47, 47);
  cursor: pointer;
}

.none {
  display: none;
}

.block {
  display: block;
}

@media (max-width: 791px){
  .promptContainer {
    .innerBox {
      width:70%;
    }
  }
}

@media (max-width: 575px){
  .promptContainer {
    .innerBox {
      width:80%;
    }
  }
}
</style>