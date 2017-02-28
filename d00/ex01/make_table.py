import json
import dominate
from dominate.tags import *

with open("periodicTable.json") as f:
	ptable = json.loads(f.read());
groups = {
	"": "g_hydrogen",
	"Element Halogen p": "g_halogen",
	"Element Noble p": "g_noble",
	"Element Alkali s" : "g_alkali_s",
	"Element Alkaline s": "g_alkaline_s",
	"Element Poor Boron p": "g_boron_p",
	"Element Metalloid Boron p": "g_boron_m",
	"Element Poor Carbon p": "g_carbon_p",
	"Element Nonmetal Carbon p": "g_carbon_nm",
	"Element Metalloid Carbon p": "g_carbon_m",
	"Element Poor Pnictogen p": "g_pgen_p",
	"Element Nonmetal Pnictogen p": "g_pgen_nm",
	"Element Metalloid Pnictogen p": "g_pgen_m",
	"Element Poor Chalcogen p": "g_chal_p",
	"Element Nonmetal Chalcogen p": "g_chal_nm",
	"Element Metalloid Chalcogen p": "g_chal_m",
	"Element Transition d": "g_trans",
	"Element Lanthanoid f": "g_lanth_f",
	"Element Lanthanoid d": "g_lanth_d",
	"Element Actinoid f": "g_acti_f",
	"Element Actinoid d": "g_acti_d",
	"Lanthanoid InnerBorder BlueLeft BlueTop BlueRight": "g_lanth_f",
	"Actinoid InnerBorder BlueLeft BlueRight": "g_acti_f"
	}
exceptions = ["Lanthanoid InnerBorder BlueLeft BlueTop BlueRight", "Actinoid InnerBorder BlueLeft BlueRight"]

h = html()
with h.add(table()):
	for k in ptable.keys():
		ttable = ptable[k]
		rows = len(ttable)
		if k == 'table':
			for i in range(rows):
				t = tr()
				cols = 0
				elems = ttable[i]['elements'] 
				for j in range(len(elems)):
					el = elems[j]
					while (cols < el['position']):
						with t.add(td()):
							div(" ",cls="cell")
						cols += 1		
					with t.add(td()):
						if el['group'] in exceptions:
							attr(_id=groups[el['group']])
							with div(cls="cell"):
								div(el['small'], cls='element')
						else:			
							with div(cls="cell", _id=groups[el['group']]):
								div(str(round(el['molar'], 4)), cls='molar')
								div(el['small'], cls='element')
								div(str(el['number']), cls='num')							
					cols += 1	
			t = tr()
			t.add(td(div(" ",cls="cell")))
		else:
			t = tr()
			cols = 0
			elems = ttable
			for j in range(len(elems)):
				el = elems[j]
				while (cols < el['position']):
					with t.add(td()):
						div(" ",cls="cell")
					cols += 1		
				with t.add(td()):			
					with div(cls="cell", _id=groups[el['group']]):
						div(str(el['molar']), cls='molar')
						div(el['small'], cls='element')
						div(str(el['number']), cls='num')						
				cols += 1
print(h)
# with open("elems.html", 'w') as out:
# 	out.write(h)
