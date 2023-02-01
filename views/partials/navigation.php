<div x-data="{open : false,
    is_shopping_cart_open: false,
    my_var: window.myGlobalVariable,
    isProcessing: true,
    cart_data: '',
    image_path:'',
    filtered_cart:'',
    quantity: '',
    async update_cart(e){
        let data = [];
        try{
            const response = await fetch('/app/public/update_cart.php');
            data = await response.json();

            this.cart_data = data;
            this.isProcessing = false;
            //for each obj in cart_data
            //if there is no any other obj in cart_data with the same product_id
            //include obj in filtered_cart
            

            this.filtered_cart = this.cart_data.filter((obj, index, self) =>
                self.findIndex(t => (t.product_id === obj.product_id)) === index
);

        }catch(e){
            console.error(e);
        }
    },
    get_img(id){
        let path = '';
       for(let i = 0 ; i < this.filtered_cart.length; i++){
        if(this.filtered_cart[i].product_id == id & this.filtered_cart[i].image_path[0] !== undefined ){
            path = this.filtered_cart[i].image_path[0];
        }
       }
       return path;
    },

    get_Quantity(id){
        const res = this.cart_data.filter(item => item.product_id == id);
        console.log(res);
        return res;
    }


}" x-init="await update_cart()">

    <div class=" bg-white h-screen fixed z-50 w-full flex flex-col items-center pt-5 space-y-3" :class="open? '' : 'hidden'">
        <div class="flex flex-col items-center space-y-3 pt-6">
            <p class="hover:underline"><a href="/app/shop">Shop</a> </p>
            <p class="hover:underline"><a href="/app/login">Profile</a> </p>
            <p class="hover:underline"><a href="/app/cart">Cart</a> </p>
        </div>
        <button @click="open = !open">
            <span class="material-symbols-outlined">
                close
            </span>
        </button>
    </div>
    <nav class="flex justify-between px-10 py-6 border-b border-black bg-white z-50 ">
        <div class="flex items-center">
            <a class="" href="">
                <p class="font-Playfair font-medium text-xl md:text-2xl">Rebel Accessoires</p>
            </a>
            <a href="/app/shop">
                <p class="font-normal pl-10 hover:underline hidden md:block pt-1 ">Shop</p>

            </a>
        </div>
        <div class="md:hidden">
            <button @click="open = !open">
                <span class="material-symbols-outlined">
                    menu
                </span>
            </button>
        </div>
        <div class="md:block hidden md:flex md:space-x-2 relative" :class="open? '' : 'hidden'">


            <!-- shopping cart -->
            <div x-show="is_shopping_cart_open" x-on:click.away="is_shopping_cart_open = false" class="absolute bg-white border  border-black h-[300px] w-[310px] inset-y-0 right-0 top-10 z-50 flex flex-col items-center ">
                <div class="h-4/6 border-b-4 border-gray-200 flex flex-col overflow-y-auto w-full divide-y divide-slate-200 ">

                    <template x-if="filtered_cart.length > 0 && !isProcessing">
                        <template x-for="product in filtered_cart">
                            <div id="product" class="flex px-10 space-x-10 py-3">
                                <div>
                                    <img class="h-20 w-18" x-bind:src="get_img(product.product_id)" alt="">
                                </div>
                                <div class="flex flex-col mt-2">
                                    <p class="text-sm font-Finlandica" x-text="product.product_name"></p>
                                    <p class="text-sm" x-text="product.product_description">Breil Watch</p>
                                    <p class="text-sm" x-text="product.product_price"></p>
                                    <p class="text-xs text-gray-600" x-text="'Quantity: ' + cart_data.filter(res => res.product_id == product.product_id).length"></p>
                                </div>
                            </div>
                        </template>
                    </template>
                    <template x-if="filtered_cart.length == 0 && !isProcessing">
                        <div class="grid grid-cols-1 place-content-center place-items-center h-full">
                            <p class="text-lg"> Your Cart is empty!
                            </p>
                            <span class="material-symbols-outlined">
                                shopping_bag
                            </span>

                            <a href="/app/shop" class="hover:underline pt-10">continue shopping</a>
                        </div>

                    </template>

                </div>
                <div class="w-full grid grid-cols-1 place-content-center justify-items-center h-2/6">

                    <a href="/app/cart" class=" text-xl border py-1 h-fit px-2 border-black cursor-pointer hover:ring-1 hover:ring-black bg-black text-white hover:opacity-75 text-center w-fit">Go to cart</a>
                </div>
            </div>
            <!--  -->
            <div class="pt-2">
                <a href="/app/login">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                </a>
            </div>
            <div class="pt-2">
                <button class="" @click="is_shopping_cart_open = !is_shopping_cart_open, update_cart()">

                    <span class="material-symbols-outlined">
                        shopping_cart
                    </span>
                </button>

            </div>
        </div>
    </nav>
</div>