  <template>
  <div id="Prompt">
    <div id="overlay"></div>
    <div class="promptContainer">
      <div class="innerBox">
        <span id="x">X</span>
        <h4>Large cod</h4>
        <p>{{msg}}</p>
        <p>{{size}} {{title}} £</p>
        <p>{{price}}</p>
      </div>
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
    size:String,
    price:String,
    extras:Array
  },
  watch: {
    displayPrompt: function(){
      this.promptDisplay()
      console.log(this.displayPrompt)
    }
  },
  data(){
    return {
      
    }
  },
  methods:{
    promptDisplay(){
      if(this.displayPrompt == 'false'){
        // document.querySelectorAll('.promptContainer')[0].style.display='none'
        // document.getElementById('overlay').style.display='none'
        document.getElementById('prompt').style.display='none'
      } else if(this.displayPrompt == 'true')
        // document.querySelectorAll('.promptContainer')[0].style.display='block'
        // document.getElementById('overlay').style.display='static'
        document.getElementById('prompt').style.display='block'
    }
  },
  mounted(){
    this.promptDisplay()

    document.getElementById('x').addEventListener('click',()=>{
      this.$emit("update-prompt",'false') //ne manjati vrednost propa unutar komponente
    })
  }
}
</script>
<style lang="scss" scoped>
// #prompt {
//   display: none;
// }

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
  // background-color:rgba(102, 101, 101, 0.6);
  position: fixed;
  left:0;
  top:0;
  z-index: 10;

}
.innerBox {
  width:600px;
  margin:115px auto 0 auto;
  background-color:white;
  border:1px solid #333;
}

#x {
  float:right;
  padding:3px 8px;
  background-color: red;
  color:#fff;
}

#x:hover {
  background-color:rgb(248, 47, 47);
  cursor: pointer;
}
</style>