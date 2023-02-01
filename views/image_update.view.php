<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>



<div class="flex flex-col items-center p-20 space-y-14" x-data="{
    current_path: '',
    current_index : 0,
    prod_id_input : '',
    current_image_id : '',
    arr : [],
    async find_images(e) {
            let data = [];
            const value = {
                val: this.prod_id_input
            };
            try {
                const response = await fetch(`../public/image_path_json.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(value)
                });

                data = await response.json();
                if(this.prod_id_input === ''){
                    this.arr = [];

                }
                if(data.length === 0){
                    this.arr = [];
                }
                for(let i = 0; i < data.length; i++){
                    for(const [key, value] of Object.entries(data[i])){
                        this.arr.push([key , value]);
                    }
                }

                <!-- fill the update path input field -->
                if(this.arr.length == 0){
                    this.arr = [];
                    this.current_path = '';
                    this.current_image_id = '';
                }else{
                    this.current_path = this.arr[this.current_index][1];
                    this.current_image_id = this.arr[this.current_index][0];
                }
                

            } catch (e) {
                console.error(e);
            }

        },
        next_image_path(){
            if(this.arr.length > 0){
                this.current_index++;
                if(this.current_index >= this.arr.length){
                    this.current_index = 0;
                }
                this.current_path = this.arr[this.current_index][1];
                this.current_image_id = this.arr[this.current_index][0];
            }

        },
        prev_image_path(){
            if(this.arr.length > 0){
                this.current_index--;
                if(this.current_index < 0){
                    this.current_index = this.arr.length - 1;
                }
                this.current_path = this.arr[this.current_index][1];
                this.current_image_id = this.arr[this.current_index][0];
            }
        }
}" id="main_component">

    <div class="flex px-20 py-10 justify-center space-x-2">
        <p class="text-center text-2xl">Update Images</p>
        <a class="pt-1" href="/app/controllers/admin_profile.php">
            <span class="material-symbols-outlined">
                settings
            </span>
        </a>
    </div>
    <form class="flex flex-col space-y-10 bg-slate-50 md:p-20" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="grid grid-cols-2 justify-items-center">
            <label for="product_id">Product Id</label>
            <div class="flex flex-col space-y-2">
                <input type="text" name="product_id" id="product_id" class="  border border-black hover:ring-1 hover:ring-black h-10  focus:outline-none px-2" x-on:keyup="find_images" x-model="prod_id_input">

                <p class="text-xs text-red-500"><?= $prod_id_err; ?></p>
            </div>
            <input class="hidden" type="text" name="current_image_id" id="" x-model="current_image_id">
        </div>
        <div class="grid grid-cols-2 justify-items-center">
            <div class=" bg-gray-100 relative">
                <span class="material-symbols-outlined absolute scale-50 inset-y-12 left-0 hover:cursor-pointer " @click="prev_image_path">
                    arrow_back_ios
                </span>
                <img class="object-contain h-36 w-36" src="" alt="product-images" id="display-img" x-bind:src="current_path">
                <span class="material-symbols-outlined absolute scale-50 inset-y-12 right-0 hover:cursor-pointer " @click="next_image_path">
                    arrow_forward_ios
                </span>
            </div>
            <div class="flex flex-col self-center">
                <label for="image_path">Update Path</label>
                <div class="flex flex-col space-y-2">
                    <input type="text" name="image_path" id="image_path" class="truncate border border-black hover:ring-1 hover:ring-black h-10  focus:outline-none px-2" x-model="current_path">
                    <p class="text-xs text-red-500"><?= $image_path_err; ?></p>
                </div>
            </div>
        </div>
        <button type="submit" name="update_image" class="border border-black hover:ring-1 hover:ring-black h-10  focus:outline-none px-2">Update Image</button>
    </form>

    <p class="text-center text-red-500"><?= $err_msg ?></p>
</div>








<?php require(__DIR__ . "\\partials\\footer.php"); ?>