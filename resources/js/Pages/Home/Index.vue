<template>
  <div>
    <div class="mb-6 flex justify-between items-center">
      <img v-if="menu.image" :src="menu.image" />
    </div>
  </div>
</template>

<script>
// import Layout from "@/Shared/FrontLayout";

export default {
  metaInfo: { title: "Hyangla Menu" },
  // layout: Layout,
  props: {
    menu: Object,
  },
};
</script>
