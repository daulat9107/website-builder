<template>
  <guest-layout title="Trading Plan">
    <main-section>
      <card-component title="Trading Plan">
      	<form action="/trading" method="get">
      	<div class="flex">
      		<div class="flex-1 mr-2">
		        <field label="Equity Type" help="Select Equity Type">
			        <control
			          v-model="form.equity_type"
			          type="select"
			          name="equity_type"
			          placeholder="Equity Type"
			          :options="[{
			          	'label':'Equity Delivery',
			          	'value':'equity-delivery',
			          },
					  {
			          	'label':'Equity Intraday',
			          	'value':'equity-intraday',
			          },
					  {
			          	'label':'Futures',
			          	'value':'futures',
			          }
			          
			          ]"
			        />
		        </field>
<field label="Exchange Type" help="Select Exchange Type">
			        <control
			          v-model="form.exchange"
			          type="select"
			          name="exchange"
			          placeholder="Exchange Type"
			          :options="[{
			          	'label':'NSE',
			          	'value':'NSE',
			          },
					  {
			          	'label':'BSE',
			          	'value':'BSE',
			          }]"
			        />
		        </field>
      		</div>
      		<div class="flex-1">
		        <field label="Initial Fund" help="Add Initial Fund">
			        <control
			          v-model="form.initial_fund"
			          type="number"
			          name="initial_fund"
			          placeholder="Initial Fund"
			          @input="getFund()"
			        />
		        </field>
      		</div>
      		<div class="flex-1">
		        <field label="Initial Fund Divide By" help="Divide the fund that you wish to use in each trade by the given value.">
			        <control
			          v-model="form.initial_fund_divide_by"
			          type="number"
			          name="initial_fund_divide_by"
			          placeholder="Divide the fund that you wish to use in each trade by the given value."
			          @input="getFund()"
			        />
		        </field>
      		</div>
      		<div class="flex-1">
		        <field label="Fund" help="The amount of funds used in each trade">
			        <control
			          v-model="form.fund"
			          type="number"
			         
			          name="fund"
			          placeholder="the amount of funds used in each trade"
			        />
		        </field>
      		</div>
      	</div>
<div class="flex">
      		<div class="flex-1 mr-2">
		        <field label="Fund Added Every Month" help="Fund Added Every Month">
			        <control
			          v-model="form.fund_added_each_month"
			          type="text"
			          name="fund_added_each_month"
			          placeholder="Fund Added Every Month"
			        />
		        </field>
      		</div>
      		<div class="flex-1">
		        <field label="Number of Trads Every Month" help="Number of Trads Every Month">
			        <control
			          v-model="form.trads"
			          type="text"
			          name="trads"
			          placeholder="Trads"
			        />
		        </field>
      		</div>
      	</div>
<div class="flex">
      		<div class="flex-1 mr-2">
		        <field label="Win Min%" help="Total number of trads you won minimum range value">
			        <control
			          v-model="form.win_precent_min"
			          type="text"
			          name="win_precent_min"
			          placeholder="Total number of trads you won minimum range value"
			        />
		        </field>
      		</div>
      		<div class="flex-1">
		        <field label="Win Max%" help="Total number of trads you won maximum range value">
			        <control
			          v-model="form.win_precent_max"
			          type="text"
			          name="win_precent_max"
			          placeholder="Total number of trads you won Maximum range value"
			        />
		        </field>
      		</div>
      	</div>
<div class="flex">
      		<div class="flex-1 mr-2">
		        <field label="Loss%" help="Loss from your total fund in percentage per trade">
			        <control
			          v-model="form.loss_percentage"
			          type="number"
			          name="loss_percentage"
			          placeholder="Loss from your total fund in percentage per trade"
			        />
		        </field>
      		</div>
      		<div class="flex-1">
		        <field label="Profit%" help="Profit from your total fund in percentage per trade">
			        <control
			          v-model="form.profit_percentage"
			          type="number"
			          name="profit_percentage"
			          placeholder="Profit from your total fund in percentage per trade"
			        />
		        </field>
      		</div>
      	</div>
<div class="flex">
      		<div class="flex-1 mr-2">
		        <field label="months" help="How many months Trade profit and loss you want to calculate">
			        <control
			          v-model="form.months"
			          type="number"
			          name="months"
			          placeholder="How many months Trade profit and loss you want to calculate"
			        />
		        </field>
      		</div>
      	</div>
      	<button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 mt-4" type="submit">Submit</button>
      	</form>
      </card-component>
	  <card-component title="Trading Plan Table month wise">
	  	<h1><b>Fund After {{ this.form.months }} Months = {{ i }}</b></h1>
		<table
            class="table-auto w-full text-sm text-left text-gray-500 dark:text-white"
            id="question_bank"
          >
            <thead
              class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
              <tr>
                <th scope="col" class="px-6 py-3"> Month</th>
                <th scope="col" class="px-6 py-3">Fund Used</th>
                <th scope="col" class="px-6 py-3">Profit/Loss with Charges</th>
                <th scope="col" class="px-6 py-3">Profit/Loss</th>
                <th scope="col" class="px-6 py-3">Charges</th>
                <th scope="col" class="px-6 py-3">Profit Trade</th>
                <th scope="col" class="px-6 py-3">Loss Trade</th>
                <th scope="col" class="px-6 py-3">Profit%  in Month</th>
                <th scope="col" class="px-6 py-3">Loss%  in Month</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                v-for= "(month,index) in months"
                :key="index"
              >
              <td class="px-6 py-4">{{ index+1 }}</td>
              <td class="px-6 py-4">{{ month.fund_used }}</td>
              <td class="px-6 py-4">{{ month.month_profit_loss_with_charges }}</td>
              <td class="px-6 py-4">{{ month.month_profit_loss }}</td>
              <td class="px-6 py-4">{{ month.charges }}</td>
              <td class="px-6 py-4">{{ month.profit_trade }}</td>
              <td class="px-6 py-4">{{ month.loss_trade }}</td>
              <td class="px-6 py-4">{{ month.profit_percentage_in_month }}</td>
              <td class="px-6 py-4">{{ month.loss_percentage_in_month }}</td>
              </tr>
            </tbody>
        </table>
	  </card-component>
    </main-section>
  </guest-layout>
</template>

<script>
import { defineComponent } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import MainSection from '@/Components/MainSection.vue';
import HeroBar from '@/Components/HeroBar.vue';
import TitleBar from '@/Components/TitleBar.vue';
import CardComponent from '@/Components/CardComponent.vue';
import Control from '@/Components/Control.vue';
import Field from '@/Components/Field.vue';

export default defineComponent({
	props:[
		'i','months'
	],
  components: {
    GuestLayout,
    MainSection,
    HeroBar,
    CardComponent,
    TitleBar,
    Control,
    Field
  },
  data() {
	    return {
	    	form:{
	    		equity_type:'equity-delivery',
	    		exchange:'BSE',
	    		initial_fund:50000,
	    		initial_fund_divide_by:2,
	    		fund:0,
	    		fund_added_each_month:50000,
	    		trads:20,
	    		win_precent_min:40,
	    		win_precent_max:70,
	    		loss_percentage:2,
	    		profit_percentage:3,
	    		months:60,
	    	}
	    }
	},
methods:{
	getFund(){

		if(this.form.initial_fund_divide_by>0){
			this.form.fund = this.form.initial_fund/this.form.initial_fund_divide_by
		}
		this.fund = this.form.initial_fund;
		
	}
},
mounted() {
	this.getFund();
}

});
</script>
