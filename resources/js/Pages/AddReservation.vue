<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link, usePage} from "@inertiajs/vue3";
import {computed, ref, watchEffect, reactive} from 'vue';
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot
} from '@headlessui/vue';
import {CheckIcon, ChevronUpDownIcon} from '@heroicons/vue/20/solid';
import dayjs from 'dayjs';

// hotels input filed data
const formHotels = ref(usePage().props.hotels);
// // Exchange Rate input filed data
const formRates = ref(usePage().props.rates);
// currency input filed data
const formCurrencies = ref(usePage().props.currencies);
// Reservation Source input filed data
const formSources = ref(usePage().props.sources);
// Payment Method input filed data
const formPayments = ref(usePage().props.payments);


// check in & check out field data
const cInOutDate = ref([null, null]);
// reservation field data
const reservationDate = ref(null);
// all select field focued data
const isCInoutFocused = ref(false);
const isReservationFocused = ref(false);
const isHotelFocused = ref(false);
const isRateFocused = ref(false);
const isCurrencyFocused = ref(false);
const isSourceFocused = ref(false);
const isPaymentFocused = ref(false);

// all selected field selected data
const selected = ref(null);
const selectedRate = ref(null);
const selectedCurrency = ref(null);
const selectedSource = ref(null);
const selectedPayment = ref(null);
const query = ref('');

// all selected field value data
const hasValue = computed(() => cInOutDate.value && cInOutDate.value[0] && cInOutDate.value[1]);
const hasValue2 = computed(() => reservationDate.value !== null);
const hasValue3 = computed(() => selected.value !== null);
const hasValue4 = computed(() => selectedRate.value !== null);
const hasCurrencyValue = computed(() => selectedCurrency.value !== null);
const hasSourceValue = computed(() => selectedSource.value !== null);
const hasPaymentValue = computed(() => selectedPayment.value !== null);

// all selected field filtered data
const filteredhotel = computed(() =>
    query.value === ''
        ? formHotels.value
        : formHotels.value.filter((hotel) =>
            hotel.hotelName
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
);
const filteredRates = computed(() =>
    query.value === ''
        ? formRates.value
        : formRates.value.filter((rate) =>
            (rate.currency + rate.rate)
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
);
const filteredCurrencies = computed(() =>
    query.value === ''
        ? formCurrencies.value
        : formCurrencies.value.filter((currency) =>
            currency.currency
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
);
const filteredsources = computed(() =>
    query.value === ''
        ? formSources.value
        : formSources.value.filter((source) =>
            source.source
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
);
const filteredPayments = computed(() =>
    query.value === ''
        ? formPayments.value
        : formPayments.value.filter((payment) =>
            payment.payment
                .toLowerCase()
                .replace(/\s+/g, '')
                .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        )
);

function handleEnter() {
    if (!selected.value || selected.value.name === 'Select Hotel') {
        selected.value = null;
    }
}


const reservationData = reactive({
    reservationNo: '',
    check_in: null,
    check_out: null,
    reservation_date: null,
    hotel: '',
    guestName: '',
    exchangeRate: '',
    advance: '',
    currency: '',
    reservation_source: '',
    payment_method: '',
    phone: '',
    email:'',
    total_adult: ''

});
watchEffect(() => {
    reservationData.check_in = cInOutDate.value?.[0] || null;
    reservationData.check_out = cInOutDate.value?.[1] || null;
    reservationData.reservation_date = reservationDate.value || null;
    reservationData.hotel = selected.value?.id || '';
    reservationData.exchangeRate = selectedRate.value?.id || '';
    reservationData.currency = selectedCurrency.value?.id || '';
    reservationData.reservation_source = selectedSource.value?.id || '';
    reservationData.payment_method = selectedPayment.value?.id || '';
});
const handleSubmit = () => {
    const formattedData = {
        ...reservationData,
        check_in: reservationData.check_in ? dayjs(reservationData.check_in).format('DD-MM-YY') : null,
        check_out: reservationData.check_out ? dayjs(reservationData.check_out).format('DD-MM-YY') : null,
        reservation_date: reservationData.reservation_date ? dayjs(reservationData.reservation_date).format('DD-MM-YY') : null,
    };

    console.log(formattedData);
}

// child age
// Add a new age selector
const childAges = ref([''])
function addChildAge() {
    if (childAges.value.length < 5) {
        childAges.value.push('')
    }
}

// Remove a specific age selector
function removeChildAge(index) {
    childAges.value.splice(index, 1)
}

// Calculate col-span for each select input so total = 6
function getColSpanClass(count) {
    switch (count) {
        case 1:
            return 'col-span-4'
        case 2:
            return 'col-span-2'
        case 3:
            return 'col-span-1'
        case 4:
            return 'col-span-1'
        case 5:
            return 'col-span-1'
        default:
            return 'col-span-1'
    }
}

// Button col-span based on count (only when count < 5)
function getButtonColSpanClass(count) {
    switch (count) {
        case 1:
            return 'col-span-1'
        case 2:
            return 'col-span-1'
        case 3:
            return 'col-span-2'
        case 4:
            return 'col-span-1'
        default:
            return 'hidden'
    }
}

// Optional: Submit each age
function submit() {
    childAges.value.forEach(age => {
        if (age !== '') {
            router.post('/child-ages', { age })
        }
    })
}

</script>

<template>
    <AdminLayout>
        <div>
            <div class="flex justify-between items-center">
                <Link href="/dashboard"
                      class="mb-4 text-white bg-cyan-950 hover:bg-blue-700 font-medium rounded-lg px-4 py-2 flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"/>
                    </svg>

                    Go Back
                </Link>
            </div>
            <div class="bg-white p-4  rounded-3xl">
                <form @submit.prevent="handleSubmit" class="gap-4 grid grid-cols-3">
                    <!--reservation no-->
                    <div class="relative">
                        <input type="text" id="floating_outlined" v-model="reservationData.reservationNo"
                               class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-500 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="floating_outlined"
                               class="absolute text-sm text-gray-500  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2  peer-focus:top-2 peer-focus:scale-75  peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                            Reservation No</label>
                    </div>
                    <!--check in & check out-->
                    <div class="relative">
                        <label
                            v-if="isCInoutFocused || hasValue"
                            class="absolute text-sm text-blue-600 scale-75 -translate-y-4 top-2 bg-white px-2 left-2 z-10 transition-all "
                        >
                            Select Check-in - check-out
                        </label>
                        <a-range-picker
                            v-model:value="cInOutDate"
                            format="DD/MM/YYYY"
                            :placeholder="['Check-in', 'Check-out']"
                            class="w-full px-2.5 pt-4 pb-2.5 border border-gray-500 rounded-lg focus:border-blue-600 h-[45px] text-gray-900"
                            @focus="isCInoutFocused = true" @blur="isCInoutFocused = false"/>
                    </div>
                    <!--reservation date-->
                    <div class="relative">
                        <label
                            v-if="isReservationFocused || hasValue2"
                            class="absolute text-sm text-blue-600 scale-75 -translate-y-4 top-2 bg-white px-2 left-2 z-10 transition-all"
                        >
                            Select Reservation Date
                        </label>
                        <a-date-picker
                            v-model:value="reservationDate"
                            format="DD/MM/YYYY"
                            placeholder="Reservation Date"
                            class="w-full px-2.5 pt-4 pb-2.5 border border-gray-500 rounded-lg focus:border-blue-600 h-[45px] text-gray-900"
                            @focus="isReservationFocused = true" @blur="isReservationFocused = false"/>
                    </div>
                    <!--hotel-->
                    <div>
                        <Combobox v-model="selected">
                            <div class="relative">
                                <!-- Floating Label -->
                                <label
                                    :class="[
                                        'absolute text-sm px-2 left-2 z-10 transition-all bg-white cursor-text',
                                        (isHotelFocused || hasValue3)
                                          ? 'text-blue-600 scale-75 -translate-y-4 top-2'
                                          : 'text-gray-500 top-1/2 -translate-y-1/2 scale-100'
                                      ]"
                                    for="floating_combobox"
                                >
                                    Select Hotel
                                </label>

                                <div
                                    class="relative w-full overflow-hidden rounded-lg border border-gray-400 bg-white text-left shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600"
                                >
                                    <ComboboxInput
                                        id="floating_combobox"
                                        class="peer w-full border-none px-3 pt-4 pb-2 text-sm leading-5 text-gray-900 focus:ring-0"
                                        :displayValue="(hotel) => hotel?.hotelName || ''"
                                        @change="query = $event.target.value"
                                        @focus="isHotelFocused = true"
                                        @blur="isHotelFocused = false"
                                        placeholder=" "
                                        @keydown.enter.prevent="handleEnter"
                                    />


                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                                    </ComboboxButton>
                                </div>

                                <!-- Dropdown Options -->
                                <TransitionRoot
                                    leave="transition ease-in duration-100"
                                    leaveFrom="opacity-100"
                                    leaveTo="opacity-0"
                                    @after-leave="query = ''"
                                >
                                    <ComboboxOptions
                                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                                    >
                                        <div
                                            v-if="filteredhotel.length === 0 && query !== ''"
                                            class="relative cursor-default select-none px-4 py-2 text-gray-700"
                                        >
                                            Nothing found.
                                        </div>

                                        <ComboboxOption
                                            v-for="hotel in filteredhotel"
                                            :key="hotel.id"
                                            :value="hotel"
                                            v-slot="{ selected, active }"
                                        >
                                            <li
                                                class="relative cursor-default select-none py-2 pl-10 pr-4"
                                                :class="{'bg-blue-600 text-white': active, 'text-gray-900': !active,}">
                                                    <span
                                                        class="block truncate"
                                                        :class="{ 'font-medium': selected, 'font-normal': !selected }"
                                                    >
                                                      {{ hotel.hotelName }}
                                                    </span>
                                                <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                    :class="{ 'text-white': active, 'text-blue-600': !active }"
                                                >
                                                  <CheckIcon class="h-5 w-5" aria-hidden="true"/>
                                                </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </TransitionRoot>
                            </div>
                        </Combobox>
                    </div>
                    <!--Guest Name-->
                    <div class="relative">
                        <input type="text" id="guestName" v-model="reservationData.guestName"
                               class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-500 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="guestName"
                               class="absolute text-sm text-gray-500  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2  peer-focus:top-2 peer-focus:scale-75  peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                            Guest Name</label>
                    </div>
                    <!--exchange rate-->
                    <div>
                        <Combobox v-model="selectedRate">
                            <div class="relative">
                                <!-- Floating Label -->
                                <label
                                    :class="[
                                        'absolute text-sm px-2 left-2 z-10 transition-all bg-white cursor-text',
                                        (isRateFocused || hasValue4)
                                          ? 'text-blue-600 scale-75 -translate-y-4 top-2'
                                          : 'text-gray-500 top-1/2 -translate-y-1/2 scale-100'
                                      ]"
                                    for="floating_combobox_rate"
                                >
                                    Select Exchange Rate
                                </label>

                                <div
                                    class="relative w-full overflow-hidden rounded-lg border border-gray-400 bg-white text-left shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600"
                                >
                                    <ComboboxInput
                                        id="floating_combobox_rate"
                                        class="peer w-full border-none px-3 pt-4 pb-2 text-sm leading-5 text-gray-900 focus:ring-0"
                                        :displayValue="(rate) => rate?.rate || ''"
                                        @change="query = $event.target.value"
                                        @focus="isRateFocused = true"
                                        @blur="isRateFocused = false"
                                        placeholder=" "
                                        @keydown.enter.prevent="handleEnter"
                                    />


                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                                    </ComboboxButton>
                                </div>

                                <!-- Dropdown Options -->
                                <TransitionRoot
                                    leave="transition ease-in duration-100"
                                    leaveFrom="opacity-100"
                                    leaveTo="opacity-0"
                                    @after-leave="query = ''"
                                >
                                    <ComboboxOptions
                                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                                    >
                                        <div
                                            v-if="filteredRates.length === 0 && query !== ''"
                                            class="relative cursor-default select-none px-4 py-2 text-gray-700"
                                        >
                                            Nothing found.
                                        </div>

                                        <ComboboxOption
                                            v-for="rate in filteredRates"
                                            :key="rate.id"
                                            :value="rate"
                                            v-slot="{ selected, active }"
                                        >
                                            <li
                                                class="relative cursor-default select-none py-2 pl-10 pr-4"
                                                :class="{'bg-blue-600 text-white': active, 'text-gray-900': !active,}">
                                                    <span
                                                        class="block truncate"
                                                        :class="{ 'font-medium': selected, 'font-normal': !selected }"
                                                    >
                                                      {{ rate.rate }}
                                                    </span>
                                                <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                    :class="{ 'text-white': active, 'text-blue-600': !active }"
                                                >
                                                  <CheckIcon class="h-5 w-5" aria-hidden="true"/>
                                                </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </TransitionRoot>
                            </div>
                        </Combobox>
                    </div>
                    <!--Total Advance-->
                    <div class="relative">
                        <input type="text" id="advance" v-model="reservationData.advance"
                               class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-500 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="advance"
                               class="absolute text-sm text-gray-500  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2  peer-focus:top-2 peer-focus:scale-75  peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                            Total Advance</label>
                    </div>
                    <!-- Currency -->
                    <div>
                        <Combobox v-model="selectedCurrency">
                            <div class="relative">
                                <label
                                    :class="[
                                        'absolute text-sm px-2 left-2 z-10 transition-all bg-white cursor-text',
                                        (isCurrencyFocused || hasCurrencyValue)
                                          ? 'text-blue-600 scale-75 -translate-y-4 top-2'
                                          : 'text-gray-500 top-1/2 -translate-y-1/2 scale-100'
                                    ]"
                                    for="floating_combobox_currency"
                                >
                                    Select Currency
                                </label>

                                <div
                                    class="relative w-full overflow-hidden rounded-lg border border-gray-400 bg-white text-left shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600"
                                >
                                    <ComboboxInput
                                        id="floating_combobox_currency"
                                        class="peer w-full border-none px-3 pt-4 pb-2 text-sm leading-5 text-gray-900 focus:ring-0"
                                        :displayValue="(rate) => rate?.currency || ''"
                                        @change="query = $event.target.value"
                                        @focus="isCurrencyFocused = true"
                                        @blur="isCurrencyFocused = false"
                                        placeholder=" "
                                        @keydown.enter.prevent="handleEnter"
                                    />
                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                                    </ComboboxButton>
                                </div>

                                <TransitionRoot
                                    leave="transition ease-in duration-100"
                                    leaveFrom="opacity-100"
                                    leaveTo="opacity-0"
                                    @after-leave="query = ''"
                                >
                                    <ComboboxOptions
                                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                                    >
                                        <div
                                            v-if="filteredRates.length === 0 && query !== ''"
                                            class="relative cursor-default select-none px-4 py-2 text-gray-700"
                                        >
                                            Nothing found.
                                        </div>

                                        <ComboboxOption
                                            v-for="currency in filteredCurrencies"
                                            :key="currency.id"
                                            :value="currency"
                                            v-slot="{ selected, active }"
                                        >
                                            <li
                                                class="relative cursor-default select-none py-2 pl-10 pr-4"
                                                :class="{'bg-blue-600 text-white': active, 'text-gray-900': !active}">
                                                <span
                                                    class="block truncate"
                                                    :class="{ 'font-medium': selected, 'font-normal': !selected }"
                                                >
                                                  {{ currency.currency }}
                                                </span>
                                                <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                    :class="{ 'text-white': active, 'text-blue-600': !active }"
                                                >
                                                  <CheckIcon class="h-5 w-5" aria-hidden="true"/>
                                                </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </TransitionRoot>
                            </div>
                        </Combobox>
                    </div>
                    <!-- Reservation Source -->
                    <div>
                        <Combobox v-model="selectedSource">
                            <div class="relative">
                                <label
                                    :class="[
                                        'absolute text-sm px-2 left-2 z-10 transition-all bg-white cursor-text',
                                        (isSourceFocused || hasSourceValue)
                                          ? 'text-blue-600 scale-75 -translate-y-4 top-2'
                                          : 'text-gray-500 top-1/2 -translate-y-1/2 scale-100'
                                    ]"
                                    for="floating_combobox_source"
                                >
                                    Select Reservation Source
                                </label>

                                <div
                                    class="relative w-full overflow-hidden rounded-lg border border-gray-400 bg-white text-left shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600"
                                >
                                    <ComboboxInput
                                        id="floating_combobox_source"
                                        class="peer w-full border-none px-3 pt-4 pb-2 text-sm leading-5 text-gray-900 focus:ring-0"
                                        :displayValue="(source) => source?.source || ''"
                                        @change="query = $event.target.value"
                                        @focus="isSourceFocused = true"
                                        @blur="isSourceFocused = false"
                                        placeholder=" "
                                        @keydown.enter.prevent="handleEnter"
                                    />
                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                                    </ComboboxButton>
                                </div>

                                <TransitionRoot
                                    leave="transition ease-in duration-100"
                                    leaveFrom="opacity-100"
                                    leaveTo="opacity-0"
                                    @after-leave="query = ''"
                                >
                                    <ComboboxOptions
                                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                                    >
                                        <div
                                            v-if="filteredsources.length === 0 && query !== ''"
                                            class="relative cursor-default select-none px-4 py-2 text-gray-700"
                                        >
                                            Nothing found.
                                        </div>

                                        <ComboboxOption
                                            v-for="source in filteredsources"
                                            :key="source.id"
                                            :value="source"
                                            v-slot="{ selected, active }"
                                        >
                                            <li
                                                class="relative cursor-default select-none py-2 pl-10 pr-4"
                                                :class="{'bg-blue-600 text-white': active, 'text-gray-900': !active}">
                                                <span
                                                    class="block truncate"
                                                    :class="{ 'font-medium': selected, 'font-normal': !selected }"
                                                >
                                                  {{ source.source }}
                                                </span>
                                                <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                    :class="{ 'text-white': active, 'text-blue-600': !active }"
                                                >
                                                  <CheckIcon class="h-5 w-5" aria-hidden="true"/>
                                                </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </TransitionRoot>
                            </div>
                        </Combobox>
                    </div>
                    <!-- Payment Method -->
                    <div>
                        <Combobox v-model="selectedPayment">
                            <div class="relative">
                                <label
                                    :class="[
                                        'absolute text-sm px-2 left-2 z-10 transition-all bg-white cursor-text',
                                        (isPaymentFocused || hasPaymentValue)
                                          ? 'text-blue-600 scale-75 -translate-y-4 top-2'
                                          : 'text-gray-500 top-1/2 -translate-y-1/2 scale-100'
                                    ]"
                                    for="floating_combobox_payment"
                                >
                                    Select Payment Method
                                </label>

                                <div
                                    class="relative w-full overflow-hidden rounded-lg border border-gray-400 bg-white text-left shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600"
                                >
                                    <ComboboxInput
                                        id="floating_combobox_payment"
                                        class="peer w-full border-none px-3 pt-4 pb-2 text-sm leading-5 text-gray-900 focus:ring-0"
                                        :displayValue="(payment) => payment?.payment || ''"
                                        @change="query = $event.target.value"
                                        @focus="isPaymentFocused = true"
                                        @blur="isPaymentFocused = false"
                                        placeholder=" "
                                        @keydown.enter.prevent="handleEnter"
                                    />
                                    <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                                    </ComboboxButton>
                                </div>

                                <TransitionRoot
                                    leave="transition ease-in duration-100"
                                    leaveFrom="opacity-100"
                                    leaveTo="opacity-0"
                                    @after-leave="query = ''"
                                >
                                    <ComboboxOptions
                                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                                    >
                                        <div
                                            v-if="filteredPayments.length === 0 && query !== ''"
                                            class="relative cursor-default select-none px-4 py-2 text-gray-700"
                                        >
                                            Nothing found.
                                        </div>

                                        <ComboboxOption
                                            v-for="payment in filteredPayments"
                                            :key="payment.id"
                                            :value="payment"
                                            v-slot="{ selected, active }"
                                        >
                                            <li
                                                class="relative cursor-default select-none py-2 pl-10 pr-4"
                                                :class="{'bg-blue-600 text-white': active, 'text-gray-900': !active}">
                                                <span
                                                    class="block truncate"
                                                    :class="{ 'font-medium': selected, 'font-normal': !selected }"
                                                >
                                                  {{ payment.payment }}
                                                </span>
                                                <span
                                                    v-if="selected"
                                                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                    :class="{ 'text-white': active, 'text-blue-600': !active }"
                                                >
                                                  <CheckIcon class="h-5 w-5" aria-hidden="true"/>
                                                </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </TransitionRoot>
                            </div>
                        </Combobox>
                    </div>
                    <!--Phone Number-->
                    <div class="relative">
                        <input type="text" id="phone" v-model="reservationData.phone"
                               class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-500 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="phone"
                               class="absolute text-sm text-gray-500  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2  peer-focus:top-2 peer-focus:scale-75  peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                            Phone Number</label>
                    </div>
                    <!--email-->
                    <div class="relative">
                        <input type="email" id="email" v-model="reservationData.email"
                               class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-500 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="email"
                               class="absolute text-sm text-gray-500  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2  peer-focus:top-2 peer-focus:scale-75  peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                            Email</label>
                    </div>
                    <!--email-->
                    <div class="relative">
                        <input type="text" id="adult" v-model="reservationData.total_adult"
                               class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-500 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="adult"
                               class="absolute text-sm text-gray-500  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2  peer-focus:top-2 peer-focus:scale-75  peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                            Total Adults</label>
                    </div>
                    <!--child age-->
                    <div class="relative col-span-2">
                        <div class="grid grid-cols-5 rounded-lg gap-2">
                            <template v-for="(age, index) in childAges" :key="index">
                                <div :class="getColSpanClass(childAges.length)">
                                    <div class="relative">
                                        <select
                                            v-model="childAges[index]"
                                            class="w-full border border-gray-500 text-gray-500 rounded-md px-3 py-3 text-sm focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                        >
                                            <option value="" disabled>Child age</option>
                                            <option v-for="n in 18" :key="n" :value="n - 1">{{ n - 1 }}</option>
                                        </select>
                                        <button
                                            v-if="childAges.length > 1"
                                            @click="removeChildAge(index)"
                                            type="button"
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center hover:bg-red-600"
                                            title="Remove"
                                        >
                                            &times;
                                        </button>
                                    </div>
                                </div>
                            </template>
                            <!-- Add Button: only show if childAges.length < 5 -->
                            <button
                                v-if="childAges.length < 5"
                                @click="addChildAge"
                                class="w-full h-11 flex items-center justify-center border-2 border-dashed border-blue-400 rounded-md text-blue-600 hover:bg-blue-100"
                                :class="getButtonColSpanClass(childAges.length)"
                                type="button"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                            </button>
                        </div>
                    </div>

                    <button type="submit">submit</button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<style scoped>
::v-deep(.ant-picker-range .ant-picker-input input::placeholder) {
    color: #6B7280;
}

::v-deep(.ant-picker .ant-picker-input input::placeholder) {
    color: #6B7280;
}
</style>


