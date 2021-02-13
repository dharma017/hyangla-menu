<template>
  <div>
    <modal :show="show" @close="close">
      <img
        class="object-contain w-full"
        slot="body"
        v-if="image"
        :src="image"
      />
    </modal>
  </div>
</template>
<script>
import Modal from "@/Shared/MarketingModal";
export default {
  props: ["show", "image"],

  components: { Modal },

  methods: {
    close: function () {
      this.$emit("close");
    },
  },
};
</script>
