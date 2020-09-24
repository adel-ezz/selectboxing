<template>
    <div class="container">
        <!--Form Addition-->
        <form action="#" method="Post" @submit="addNew">
            <div class="row">

                <div class="col-md-5">
                    <input class="form-control" :class="error ?'alert-danger':''" placeholder="Put unique Name"
                           v-model="newName" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="form-control btn btn-success">Add</button>
                </div>

            </div>
        </form>
        <!--Form Addition-->
        <br>
        <div class="row">
            <div class="col-md-5">
                <select size="30" class="form-control" id="list1">
                    <option v-for="item in list1" :value="item.id">{{item.name}}</option>
                </select>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary btn-block mb-2" @click="oneToleft">
                    <i class="fas fa-angle-left"></i>
                </button>
                <button class="btn btn-primary btn-block mb-2" @click="oneToRight">
                    <i class="fas fa-angle-right"></i>
                </button>
            </div>
            <div class="col-md-5">
                <select size="30" class="form-control" id="list2">
                    <option v-for="item2 in list2" :value="item2.id">{{item2.name}}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "listsComponent",
        data: function () {
            return {
                list1: [],
                list2: [],
                newName: "",
                error: false,
            };
        },
        methods: {
            //=====To list1=====////
            oneToRight: function () {
                const self = this;
                var select = document.getElementById('list1').value;
                if (select != '') {
                    console.log(typeof (this.list1));
                    var foundDoc = this.list1.find((elemt) => {
                        return elemt.id == select;
                    });
                    axios.post('/ChangeList', {
                        id: select,
                    }).then(function (response) {
                        if (response.status === 200) {
                            self.list2.push(foundDoc);
                            self.list1.splice(self.list1.indexOf(foundDoc), 1);
                        } else {
                            self.error = true;
                        }
                    }).catch(function (error) {
                        self.error = true;
                        currentObj.output = error;
                    });
                }
            },
            //==== To list2====///
            oneToleft: function () {
                const self = this;
                var select = document.getElementById('list2').value;
                if (select != '') {
                    var foundDoc = this.list2.find((elemt) => {
                        return elemt.id == select;
                    });
                    axios.post('/ChangeList', {
                        id: select,
                    }).then(function (response) {
                        if (response.status === 200) {
                            self.list1.push(foundDoc);
                            self.list2.splice(self.list2.indexOf(foundDoc), 1);
                        } else {
                            self.error = true;
                        }
                    })
                        .catch(function (error) {
                            self.error = true;
                            currentObj.output = error;
                        });
                }
            },
            //===========Add New Name========//
            addNew(e) {
                const self = this;
                e.preventDefault();
                let currentObj = this;
                axios.post('/Lists', {
                    name: this.newName,
                }).then(function (response) {
                    if (response.status === 200) {
                        self.newName = "";
                        self.list1.push(response.data.data);
                        self.error = false;
                    } else {
                        self.error = true;
                    }
                })
                    .catch(function (error) {
                        self.error = true;
                        currentObj.output = error;
                    });
            },
            //======Catch Data=======///
            getLists() {
                axios.get('/Lists')
                    .then((response) => {
                        this.list1 = response.data.data.list1;
                        this.list2 = response.data.data.list2;

                        console.log(this.list1);
                    })
            }
        },
        created() {
            this.getLists()
        }
    }
</script>


