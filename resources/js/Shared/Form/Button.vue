<template>
  <button
      :type='type'
      class='my-2 mx-2 inline-flex text-center items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150'
  >

    <slot class='text-center'/>
  </button>
</template>

<script setup>
defineProps({
  type: {
    type: String,
    default: 'submit'
  }
})
</script>
