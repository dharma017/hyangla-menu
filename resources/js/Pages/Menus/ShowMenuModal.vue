<template>
  <div>
    <modal :show="show" @close="close">
      <!-- //The elements that we wanted to be shown or used. -->
      <h3 slot="header" class="text-indigo-400 font-medium">
        Menu Description
      </h3>
      <div slot="body" v-html="description" style="white-space: pre-wrap"></div>
    </modal>
  </div>
</template>

<script>
import Modal from "@/Shared/Modal";

export default {
  props: ["show", "description"],

  components: { Modal },

  methods: {
    close: function () {
      this.$emit("close");
    },
  },
};
</script>
