<template>
  <v-container>
    <h2 style="font-weight: 400 !important">MANTER OPERADORA</h2>
    <v-divider class="mb-15"></v-divider>
    <v-card outlined class="pa-8">
      <v-row class="text-center">
        <v-col class="d-flex" cols="3" sm="3">
          <v-select
            :items="operadoras"
            label="LISTAR OPERADORA"
            outlined
          ></v-select>
        </v-col>

        <v-col class="d-flex ml-4" cols="3" sm="3">
          <v-select :items="status" item-value="status.index" @change="filter" label="STATUS" outlined></v-select>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="2" sm="2">
          <v-btn
            color="grey lighten-3"
            rounded
            large
            class="mb-2"
            @click="editItem(defaultItem)"
          >
            <v-icon medium class="mr-1"> mdi-plus </v-icon>
            NOVO</v-btn
          >
        </v-col>
      </v-row>

      <v-row class="text-center">
        <v-col cols="2" sm="2">
          <v-checkbox
            v-model="checkbox1"
            :label="`Marcar Todos`"
            class="ml-4"
          ></v-checkbox>
        </v-col>

        <v-col cols="2" sm="2">
          <v-btn depressed large @click="deleteItem"
            ><v-icon class="mr-2">mdi-delete-forever</v-icon> EXCLUIR</v-btn
          >
        </v-col>

        <v-col class="d-flex" cols="2" sm="2">
          <v-btn depressed large>
            HABILITAR E <br />
            DESABILITAR</v-btn
          >
        </v-col>
      </v-row>
      <v-data-table
        v-model="selectedItems"
        :headers="headers"
        :items="operadoras"
        sort-by="calories"
        class="elevation-0"
        show-select
      >
        <template v-slot:top>
          <v-dialog v-model="dialog" max-width="500px">
            <v-card>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field
                        v-model="editedItem.title"
                        label="Operadora"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="12" md="12">
                      <v-text-field
                        v-model="editedItem.text"
                        label="Descrição"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close"
                  >Cancelar</v-btn
                >
                <v-btn color="blue darken-1" text @click="save(editedItem)"
                  >Salvar</v-btn
                >
              </v-card-actions>
            </v-card>
          </v-dialog>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-row>
            <v-icon medium class="mr-2" @click="editItem(item)">
              mdi-pencil
            </v-icon>
            <v-switch value input-value="true"></v-switch>
          </v-row>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="initialize">Reset</v-btn>
        </template>
      </v-data-table>
    </v-card>
  </v-container>
</template>

<script>
import Operadoras from "../services/operadoras";
export default {
  name: "HelloWorld",

  data: () => ({
    checkbox1: false,
    status: ["Todos", "Ativos", "Inativos"],
    dialog: false,
    headers: [
      { text: "", value: "actions", sortable: false },
      { text: "Operadora", value: "title" },
      { text: "Descrição", value: "text" },
    ],
    operadoras: [],
    selectedItems: [],
    selectedStatus: 0,
    editedIndex: -1,
    editedItem: {
      title: "",
      text: "",
    },
    defaultItem: {
      title: "",
      text: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    checkbox1(val) {
      if (val) {
        console.log(val);
      }
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      Operadoras.index().then((res) => {
        this.operadoras = res.data;
      });
    },

    filter() {
     console.log(this.selectedStatus);
    },

    editItem(item) {
      this.editedIndex = this.operadoras.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem() {
      for (let _item of this.selectedItems) {
        Operadoras.destroy(_item.id).then((res) => {
          console.log(res);
        });
      }
      let _self = this;
      _self.close();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });

      let _self = this;
      _self.initialize();
    },

    save(operadora) {
      if (this.editedIndex > -1) {
        Operadoras.update(operadora).then((res) => {
          console.log(res);
        });
      } else {
        Operadoras.store(operadora).then((res) => {
          console.log(res);
        });
      }
      let _self = this;
      _self.close();
    },
  },
};
</script>