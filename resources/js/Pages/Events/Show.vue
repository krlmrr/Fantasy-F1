<template>
  <Header :title="event.name" />

  <PageHeader :title="event.name" />

  <img
    v-if="event.track[0].track_photo"
    class="mx-auto my-4 w-64"
    :src="event.track[0].track_photo"
  />

  <Table
    title="Results"
    :headers="headers"
  >
    <tr
      v-for="result in results"
      :key="result.id"
    >
      <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">
        {{ result.finish_pos }}
      </td>
      <td
        class="whitespace-nowrap py-4 w-96 pl-4 pr-3 text-center text-sm font-medium text-gray-900"
      >
        <Link
          class="text-orange-600"
          :href="
            route('driver.show', {
              franchise: franchise.slug,
              driver: result.driver.id,
            })
          "
        >
          {{ result.driver.first_name + ' ' + result.driver.last_name }}
        </Link>
      </td>
      <td
        class="whitespace-nowrap py-4 w-96 pl-4 pr-3 text-center text-sm font-medium text-gray-900"
      >
        <Link
          class="text-orange-600"
          :href="
            route('constructor.show', {
              franchise: franchise.slug,
              slug: result.driver.constructor.slug,
            })
          "
        >
          {{ result.driver.constructor.short_name }}
        </Link>
      </td>
      <td
        class="whitespace-nowrap px-3 w-96 py-4 text-center text-sm text-gray-500"
      >
        {{ result.starting_pos }}
      </td>
      <td
        class="whitespace-nowrap px-3 w-96 py-4 text-center text-sm text-gray-500"
      >
        <span v-if="result.fastest_lap"> Fastest Lap </span>
      </td>
      <td
        class="whitespace-nowrap px-3 w-96 py-4 text-center text-sm text-gray-500"
      >
        <span v-if="result.DNF"> DNF </span>
      </td>
      <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">
        {{ result.points_for_race }}
      </td>
    </tr>
  </Table>
</template>

<script setup>
  import PageHeader from '@/Shared/PageHeadings/PageHeader.vue'
  import Table from '@/Shared/Tables/Table.vue'

  const props = defineProps({
    franchise: Object,
    event: Object,
    results: Array,
  })

  const headers = [
    'Finished',
    'Driver',
    'Constructor',
    'Started',
    'Fastest Lap',
    'DNF',
    'Points Earned',
  ]
</script>
