<template>
<div class="order">
  <v-container>
  <h1>This is an order page</h1>
    <Prompt id="prompt" 
      @update-prompt="updatePrompt"
      msg="Are you sure you would like to order this?" :displayPrompt='promptDisplay' 
      :title="promptedItem.title"
      :size="promptedItem.size"
      :price="promptedItem.price"
      :extras="promptedItem.extras"
    />


    <v-row>
      <v-col cols="12" id="availableFood">
          <ul v-for="(item, index) in items" :key="index">
            <h3>{{item.size}} {{item.title}}</h3>
            <li><strong>Price: </strong>{{item.price}} £</li>
            <li><strong><em>Extras:</em></strong>

              <ol>
                <li v-for="(extra, indexEx) in item.extras" :key="indexEx">
                  <span>{{indexEx+1}}: {{extra}}</span>
                </li>
              </ol>

              <v-btn
              class="red white--text"
              @click="addToCart(index)"
              >
              Add to cart
              </v-btn>
            </li>
          </ul>
      </v-col>
    </v-row>
  </v-container>
</div>
</template>
<script>
import Prompt from '../components/Prompt.vue'
export default {
  name: 'Order',
  components: {
    Prompt
  },
  data(){
    return {
      promptDisplay:'true',
      promptedItem:{
        title: '',
        size: '',
        price:'' ,
        extras: []
      },
      items: [
        {
          title: 'Cod',
          size: 'Regular',
          price: 4.30,
          extras: [
            'salt',
            'vinager'
          ]
        },
        {
          title: 'Cod',
          size: 'Large',
          price: 5.03,
          extras: [
            'salt',
            'vinager'
          ]
        },
        {
          title: 'Cod',
          size: 'Large',
          price: 5.25,
          extras: [
            'salt',
            'vinager'
          ]
        },
        {
          title: 'Cod',
          size: 'Large',
          price: 5.29,
          extras: [
            'salt',
            'vinager'
          ]
        },
        {
          title: 'Cod',
          size: 'Large',
          price: 2.30,
          extras: [
            'salt',
            'vinager'
          ]
        },
        {
          title: 'Cod',
          size: 'Large',
          price: 5.24,
          extras: [
            'salt',
            'vinager'
          ]
        }
      ]
    }
  },
  methods: {
    priceDecimals(){
      for(var a = 0; a < this.items.length; a++){
        var check = this.items[a].price.toString();

        if(check[check.length-2] == '.'){
          this.items[a].price = check + '0';
        } else {
          this.items[a].price = this.items[a].price.toString()
        }

        console.log(this.items[a].price)
      }
    },

    addToCart(index){
      // console.log(this.items[index])
      this.promptedItem.title = this.items[index].title
      this.promptedItem.size = this.items[index].size
      this.promptedItem.price = this.items[index].price
      this.promptedItem.extras = this.items[index].extras
      // console.log(this.promptedItem)

      this.promptDisplay = 'true'
    },

    updatePrompt(){
      this.promptDisplay = 'false'
    }
  },
  mounted(){
    this.priceDecimals()
    this.promptDisplay = 'false'
  },
  updated(){
    this.priceDecimals()
  }
}
</script>
<style scoped lang="scss">
#availableFood {
  display:flex;
  justify-content: center;
  flex-wrap: wrap;
  flex-direction: row;
  ul {
  width:350px;
  padding:20px;
  margin:10px;
  border:1px solid #333;
    h3 {
      text-align: left;
    }
    li {
      list-style-type: none;
      text-align: left;
    }
  }
}
</style>
