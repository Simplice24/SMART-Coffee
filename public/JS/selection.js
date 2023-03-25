                   function populate(s1,s2){
          var s1= document.getElementById(s1);
          var s2=document.getElementById(s2);
          s2.innerHTML="";
          
          if(s1.value=="western"){
              var optionArray = ["|","karongi|Karongi","ngororero|Ngororero","nyabihu|Nyabihu","nyamasheke|Nyamasheke","rubavu|Rubavu","rusizi|Rusizi","rutsiro|Rutsiro"];
          }
          else if(s1.value=="eastern"){
              var optionArray = ["|","nyagatare|Nyagatare","gatsibo|Gatsibo","kayonza|Kayonza","rwamagana|Rwamagana","kirehe|Kirehe","ngoma|Ngoma","bugesera|Bugesera"];
          }
          else if(s1.value=="southern"){
              var optionArray = ["|","kamonyi|Kamonyi","muhanga|Muhanga","ruhango|Ruhango","nyanza|Nyanza","huye|Huye","gisagara|Gisagara","nyamagabe|Nyamagabe","nyaruguru|Nyaruguru"];
          }
          else if(s1.value=="northern"){
              var optionArray = ["|","musanze|Musanze","burera|Burera","gakenke|Gakenke","rurindo|Rurindo","gicumbi|Gicumbi"];
          }
		  else if(s1.value=="kigali city"){
              var optionArray = ["|","nyarugenge|Nyarugenge","gasabo|Gasabo","kicukiro|Kicukiro"];
          }
          for(var option in optionArray){
              var pair= optionArray[option].split("|");
              var newOption=document.createElement("option");
              newOption.value = pair[0];
              newOption.innerHTML = pair[1];
              s2.options.add( newOption);
          }
          }


          function populate1(s3,s4){
          var s3= document.getElementById(s3);
          var s4=document.getElementById(s4);
          s4.innerHTML="";
          
          if(s3.value=="karongi"){
		  
              var optionArray = ["|","gishyita|Gishyita", "bwishyura|Bwishyura", "gishari|Gishari", "gitesi|Gitesi","mubuga|Mubuga", "murambi|Murambi", "murundi|Murundi", "mutuntu|Mutuntu", "rubengera|Rubengera","rugabano|Rugabano", "ruganda|Ruganda", "rwankuba|Rwankuba", "twumba|Twumba"];
          }
          else if(s3.value=="ngororero"){
              var optionArray = ["|","kabaya|Kabaya", "bwira|Bwira", "gatumba|Gatumba", "hindiro|Hindiro", "kageyo|Kageyo","kavumu|Kavumu", "matyazo|Matyazo", "muhanda|Muhanda", "muhororo|Muhororo","ndaro|Ndaro", "ngororero|Ngororero", "nyange|Nyange", "sovu|Sovu"];
          }
          else if(s3.value=="nyabihu"){
           var optionArray = ["|","bigogwe|Bigogwe", "kabatwa|Kabatwa", "jenda|Jenda", "jomba|Jomba","mukamira|Mukamira","muringa|Muringa","rambura|Rambura","kintobo|Kintobo","karago|Karago","shyira|Shyira","rugera|Rugera","rurembo|Rurembo"];
         }
          else if(s3.value=="nyamasheke"){
            var optionArray = ["|","kanjongo|Kanjongo", "bushekeri|Bushekeri", "cyato|Cyato", "kagano|Kagano","karambi|Karambi", "karengera|Karengera", "kilimbi|Kilimbi", "macuba|Macuba","mahembe|Mahembe", "rangiro|Rangiro", "ruharambuge|Ruharambuge", "shangi|shangi"];
         }
		 else if(s3.value=="rubavu"){
            var optionArray = ["|","gisenyi|Gisenyi", "rubavu|Rubavu", "busasamana|Busasamana", "rugerero|Rugerero","bugeshyi|Bugeshyi","mudende|Mudende","kanzenze|Kanzenze","nyakiliba|Nyakiliba","cyanzarwe|Cyanzarwe","nyamyumba|Nyamyumba","kanama|Kanama","nyundo|Nyundo"];
          }
		  else if(s3.value=="rusizi"){
            var optionArray = ["|","nkombo|Nkombo", "bugarama|Bugarama", "butare|Butare", "bweyeye|Bweyeye","gikundamvura|Gikundamvura", "gashonga|Gashonga", "giheke|Giheke", "gihundwe|Gihundwe","gitambi|Gitambi", "kamembe|Kamembe", "muganza|Muganza", "mururu|Mururu","nkanka|Nkanka", "nkungu|Nkungu", "nyakabuye|Nyakabuye", "nyakarenzo|Nyakarenzo", "nzahaha|Nzahaha", "rwimbogo|Rwimbogo"];
          }
		  else if(s3.value=="rustiro"){
            var optionArray = ["|","kivumu|Kivumu", "kigeyo|Kigeyo", "nyabirasi|Nyabirasi"," boneza|Boneza", "musasa|Musasa", "mushonyi|Mushonyi", "ruhango|Ruhango", "murunda|Murunda", "gihango|Gihango", "mushubati|Mushubati", "manihira|Manihira", "mukura|Mukura", "rusebeyaRusebeya"];
          }
		  else if(s3.value=="nyarugenge"){
            var optionArray = ["|","nyarugenge|Nyarugenge", "muhima|Muhima", "nyamirambo|Nyamirambo"," kimisagara|Kimisagara", "kanyinya|Kanyinya", "kigali|Kigali", "gitega|Gitega", "mageragere|Mageragere", "nyakabanda|Nyakabanda", "rwezamenyo|Rwezamenyo"];
          }
		  else if(s3.value=="gasabo"){
            var optionArray = ["|","gisozi|Gisozi", "kinyinya|Kinyinya", "kacyiru|Kacyiru","remera|Remera","bumbogo|Bumbogo","gatsata|Gatsata","jali|Jali","gikomero|Gikomero","jabana|Jabana","ndera|Ndera","nduba|Nduba","rusororo|Rusororo","rutunga|Rutunga","kimihurura|Kimihurura","kimironko|Kimironko"];
          }
		  else if(s3.value=="kicukiro"){
            var optionArray = ["|","kanombe|Kanombe", "gahanga|Gahanga", "kicukiro|Kicukiro", "niboyi|Niboyi","kagarama|Kagarama","gatenga|Gatenga","gikondo|Gikondo","nyarugunga|Nyarugunga","kigarama|Kigarama","masaka|Masaka"];
          }
		  else if(s3.value=="musanze"){
            var optionArray = ["|","busogo|Busogo", "cyuve|Cyuve", "gacaca|Gacaca","gashaki|Gashaki","gataraga|Gataraga","kimonyi|Kimonyi","kinigi|Kinigi","muhoza|Muhoza","muko|Muko","musanze|Musanze","nkotsi|Nkotsi","nyange|Nyange","remera|Remera","rwaza|Rwaza","shingiro|Shingiro"];
          }
		  else if(s3.value=="burera"){
            var optionArray = ["|","bungwe|Bungwe", "butaro|Butaro", "cyanika|Cyanika", "gahunga|Gahunga","gitovu|Gitovu","kagogo|Kagogo","kinoni|Kinoni","kinyababa|Kinyababa","kivuye|Kivuye","nemba|Nemba","rugarama|Rugarama","rugengabari|Rugengabari","ruhunde|Ruhunde","rusarabuye|Rusarabuye","rwerere|Rwerere"];
          }
		  else if(s3.value=="gakenke"){
            var optionArray = ["|","busengo|Busengo", "coko|Coko", "cyabingo|Cyabingo", "gakenke|Gakenke","gashenyi|Gashenyi","mugunga|Mugunga","janja|Janja","kamabuye|Kamabuye","karambo|Karambo","kivuruga|Kivuruga","mataba|Mataba","minazi|Minazi","muhondo|Muhondo","muyongwe|Muyongwe","muzo|Muzo","nemba|Nemba","ruli|Ruli","rusasa|Rusasa","rushashi|Rushashi"];
          }
		  else if(s3.value=="rurindo"){
            var optionArray = ["|","base|base", "burega|burega", "bushoki|bushoki", "buyoga|buyoga","cyinzuzi|cyinzuzi","cyungo|cyungo","kinihira|kinihira","kisaro|kisaro","masoro|masoro","mbogo|mbogo","murambi|murambi","ngoma|ngoma","ntarabana|ntarabana","rukozo|rukozo","rusiga|rusiga","shyorongi|shyorongi","tumba|tumba"];
          }
		  else if(s3.value=="gicumbi"){
            var optionArray = ["|","bukure|bukure", "bwisige|bwisige", "byumba|byumba","cyumba|cyumba","giti|giti","kaniga|kaniga","manyagiro|manyagiro","miyove|miyove","kageyo|kageyo","mukarange|mukarange","muko|muko","mutete|mutete","nyamiyaga|nyamiyaga","nyankenke II|nyankenke II","rubaya|rubaya","rukomo|rukomo","rushaki|rushaki","rutare|rutare","ruvune|ruvune","rwamiko|rwamiko","shangasha|shangasha"];
          }
		  else if(s3.value=="nyagatare"){
            var optionArray = ["|","nyagatare|nyagatare", "gatunda|gatunda", "kiyombe|kiyombe","karama|karama","karangazi|karangazi","katabagemu|katabagemu","matimba|matimba","mimuli|mimuli","mukama|mukama","musheli|musheli","rukomo|rukomo","rwempasha|rwempasha","rwimiyaga|rwimiyaga","tabagwe|tabagwe"];
          }
		  else if(s3.value=="gatsibo"){
            var optionArray = ["|","gasange|gasange", "gatsibo|gatsibo", "gitoki|gitoki", "kabarore|kabarore","kageyo|kageyo","kiramuruzi|kiramuruzi","kiziguro|kiziguro","muhura|muhura","murambi|murambi","ngarama|ngarama","nyagihanga|nyagihanga","remera|remera","rugarama|rugarama","rwimbogo|rwimbogo"];
          }
		  else if(s3.value=="kayonza"){
            var optionArray = ["|","gahini|gahini", "kabare|kabare", "kabarondo|kabarondo", "mukarange|mukarange","murama|murama","murundi|murundi","mwiri|mwiri","ndego|ndego","nyamirama|nyamirama","rukara|rukara","ruramira|ruramira","rwinkwavu|rwinkwavu"];
          }
		  else if(s3.value=="rwamagana"){
            var optionArray = ["|","fumbwe|fumbwe", "gashengeri|gashengeri", "gishari|gishari", "karenge|karenge","kigabiro|kigabiro","muhazi|muhazi","munyaga|munyaga","munyiginya|munyiginya","musha|musha","muyumbu|muyumbu","mwulire|mwulire","nyakariro|nyakariro","nzige|nzige","rubona|rubona"];
          }
		  else if(s3.value=="kirehe"){
            var optionArray = ["|","gahara|gahara", "gatore|gatore", "kigarama|kigarama", "kigina|kigina","kirehe|kirehe","mahama|mahama","mpanga|mpanga","musaza|musaza","mushikiri|mushikiri","nasho|nasho","nyamugari|nyamugari","nyarubuye|nyarubuye"];
          }
		  else if(s3.value=="ngoma"){
            var optionArray = ["|","gashanda|gashanda", "jarama|jarama", "karembo|karembo", "kazo|kazo","kibungo|kibungo","mugesera|mugesera","murama|murama","mutenderi|mutenderi","remera|remera","rukira|rukira","rukumberi|rukumberi","rurenge|rurenge","sake|sake","zaza|zaza"];
          }
		  else if(s3.value=="bugesera"){
            var optionArray = ["|","gashora|gashora", "juru|juru", "kamabuye|kamabuye","ntarama|ntarama","mareba|mareba","mayange|mayange","musenyi|musenyi","mwogo|mwogo","ngeruka|ngeruka","nyamata|nyamata","nyarugenge|nyarugenge","rilima|rilima","ruhuha|ruhuha","rweru|rweru","shyara|shyara"];
          }
		  else if(s3.value=="kamonyi"){
            var optionArray = ["|","gacurabwenge|gacurabwenge", "karama|karama", "kayenzi|kayenzi","kayumbu|kayumbu","mugina|mugina","musambira|musambira","ngamba|ngamba","nyamiyaga|nyamiyaga","nyarubaka|nyarubaka","rugalika|rugalika","rukoma|rukoma","runda|runda"];
          }
		  else if(s3.value=="muhanga"){
            var optionArray = ["|","cyeza|cyeza" , "shyogwe|shyogwe", "nyamabuye|nyamabuye", "rugendabari|rugendabari","muhanga|muhanga","nyarusange|nyarusange","kibangu|kibangu","nyabinoni|nyabinoni","rongi|rongi","kabacuzi|kabacuzi","mushishiro|mushishiro","kiyumbu|kiyumbu"];
          }
		  else if(s3.value=="ruhango"){
            var optionArray = ["|","kinazi|kinazi", "byimana|byimana", "bweramana|bweramana", "mbuye|mbuye","ruhango|ruhango","mwendo|mwendo","kinihira|kinihira","ntongwe|ntongwe","kabagari|kabagari"];
          }
		  else if(s3.value=="nyanza"){
            var optionArray = ["|","busasamana|busasamana", "busoro|busoro", "cyabakamyi|cyabakamyi", "kibirizi|kibirizi","kigoma|kigoma","mukingo|mukingo","muyira|muyira","ntyazo|ntyazo","nyagisozi|nyagisozi","rwabicuma|rwabicuma"];
          }
		  else if(s3.value=="huye"){
            var optionArray = ["|","gishamvu|gishamvu", "huye|huye", "karama|karama", "kigoma|kigoma","kinazi|kinazi","maraba|maraba","mbazi|mbazi","mukura|mukura","ngoma|ngoma","ruhashya|ruhashya","rusatira|rusatira","rwaniro|rwaniro","simbi|simbi","tumba|tumba"];
          }
		  else if(s3.value=="gisagara"){
            var optionArray = ["|","gikonko|gikonko", "gishibi|gishibi", "kansi|kansi", "kibilizi|kibilizi","kigembe|kigembe","mamba|mamba","muganza|muganza","mukombwa|mukombwa","mukindo|mukindo","musha|musha","ndora|ndora","nyanza|nyanza","save|save"];
          }
		  else if(s3.value=="nyamagabe"){
            var optionArray = ["|","buruhukiro|buruhukiro", "cyanika|cyanika", "gatare|gatare", "kaduha|","kamegeli|kamegeli","kibirizi|kibirizi","kibugwe|kibugwe","kitabi|kitabi","mbazi|mbazi","mugano|mugano","musange|musange","musebeye|musebeye","mushubi|mushubi","nkomane|nkomane","gasaka|gasaka","tare|tare","uwinkindi|uwinkindi"];
          }
		  else if(s3.value=="nyaruguru"){
            var optionArray = ["|","cyahinda|cyahinda", "busanze|busanze", "kibeho|kibeho","mata|mata","munini|munini","kivu|kivu","ngera|ngera","ngoma|ngoma","nyabimana|nyabimana","nyagisozi|nyagisozi","muganza|muganza","ruheru|ruheru","rusenge|rusenge"];
          }
          for(var option in optionArray){
              var pair= optionArray[option].split("|");
              var newOption=document.createElement("option");
              newOption.value = pair[0];
              newOption.innerHTML = pair[1];
              s4.options.add(newOption);
			  console.log(s3.value);
          }
          }

          function populate2(s5,s6){
          var s5= document.getElementById(s5);
          var s6=document.getElementById(s6);
          s6.innerHTML="";
          
          if(s5.value=="bigogwe"){
              var optionArray = ["|","kijote|Kijote","rega|Rega","arusha|Arusha","muhe|Muhe","kora|Kora","basumba|Basumba"];
          }
          else if(s5.value=="kabatwa"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="jenda"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="mukamira"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="rambura"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="karago"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="jomba"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rurembo"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muringa"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kintobo"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rugera"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="shyira"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gishyita"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="bwishyura"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="gishari"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="gitesi"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mubuga"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="murambi"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="murundi"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mutuntu"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rubengera"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rugabano"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ruganda"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rwankuba"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="twumba"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="kanjongo"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="bushekeri"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="cyato"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kagano"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="karambi"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="karengera"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kilimbi"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="macuba"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mahembe"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rangiro"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="ruharambuge"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="shangi"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="nkombo"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="bugarama"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="butare"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="bweyeye"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gikundamvura"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gashonga"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="giheke"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gihundwe"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gitambi"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="kamembe"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="muganza"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="mururu"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nkanka"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nkungu"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyakabuye"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyakarenzo"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nzahaha"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rwimbogo"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kabaya"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="bwira"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="gatumba"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="hindiro"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="kageyo"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="karago"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kavumu"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="matyazo"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muhanda"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muhororo"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ndaro"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ngororero"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyange"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="sovu"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="gisenyi"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="rubavu"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="busasamana"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rugerero"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="bugeshi"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mudende"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kanzenze"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyakiliba"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="cyanzarwe"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyamyumba"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="kanama"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="nyundo"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="kivumu"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kigeyo"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyabirasi"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="boneza"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="musasa"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mushonyi"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ruhango"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="murunda"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gihango"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="musambira"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="manihira"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="mukura"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="musebeya"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyagatare"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gatunda"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kiyombe"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="karama"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="karangazi"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="katabagemu"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="matimba"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="mimuli"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="mukama"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="musheli"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rukomo"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rwempasha"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rwimiyaga"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gasange"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gatsibo"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gitoki"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kabarore"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kageyo"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="kiramuruzi"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="kiziguro"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="muhura"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="murambi"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ngarama"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyagihanga"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="remera"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rugarama"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rwimbogo"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="fumbwe"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gashengeri"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="gishari"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="karenge"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="kigabiro"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muhazi"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="munyaga"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="munyiginya"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="musha"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muyumbu"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mwulire"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyakariro"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nzige"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="rubona"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="gahini"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="kabare"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kabarondo"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mukarange"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="murama"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="murundi"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mwiri"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ndego"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyamirama"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rukara"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="ruramira"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="rwinkwavu"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="gahara"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gatore"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kigarama"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kigina"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kirehe"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mahama"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mpanga"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="musaza"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mushikiri"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="nasho"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="nyamugari"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="nyarubuye"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gashanda"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="jarama"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="karembo"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kazo"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kibungo"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mugesera"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="murama"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mutenderi"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="remera"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="rukira"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="rukumberi"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rurenge"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="sake"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="zaza"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gashora"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="juru"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kamabuye"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ntarama"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mareba"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="mayange"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="musenyi"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="mwogo"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ngeruka"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyamata"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyarugenge"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rilima"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ruhuha"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rweru"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="shyara"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="busogo"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="cyuve"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="gacaca"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="gashaki"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gataraga"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kimonyi"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kinigi"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muhoza"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muko"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="musanze"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nkotsi"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nyange"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="remera"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="rwaza"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="shingiro"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="bungwe"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="butaro"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="cyanika"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gahunga"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gitovu"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kagogo"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="shyira"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kinoni"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="kinyababa"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="kivuye"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="nemba"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rugarama"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rugengabari"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ruhunde"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rusarabuye"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rwerere"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="busengo"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="coko"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="cyabingo"){
            var optionArray = ["|","ngando|Ngando","gihorwe|Gihorwe","gasoro|GASORO","karambi|KARAMBI","nyabubare|NYABUBARE","nyagapfizi|NYAGAPFIZI","rugarama|RUGARAMA"];
         }
          else if(s5.value=="gakenke"){
             var optionArray = ["|","gasiza|Gasiza","kareba|Kareba","kamucuzi|KAMUCUZI","nyabitare|NYABITARE","rurenda|RURENDA","rusisiro|RUSISIRO"];
          }
         else if(s5.value=="gashenyi"){
            var optionArray = ["|","kanyove|Kanyove","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
        }
		else if(s5.value=="mugunga"){
           var optionArray = ["|","nyundo|Nyundo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="janja"){
           var optionArray = ["|","kadahenda|Kadahenda","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kamabuye"){
           var optionArray = ["|","nyamitanzi|Nyamitanzi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="karambo"){
           var optionArray = ["|","murambi|Murambi","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="kivuruga"){
           var optionArray = ["|","rwantobo|Rwantobo","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="mataba"){
           var optionArray = ["|","gatovu|Gatovu","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="minazi"){
           var optionArray = ["|","gakoro|Gakoro","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muhondo"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muyongwe"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="muzo"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="nemba"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="ruli"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rusasa"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="rushashi"){
           var optionArray = ["|","mpinga|Mpinga","ngoma ii|NGOMA II","ngoma iii|NGOMA III","ngoma iv|NGOMA IV","ngoma v|NGOMA V","ngoma vi|NGOMA VI"];
         }
		 else if(s5.value=="gacurabwenge"){
           var optionArray = ["|","gihinga|gihinga","gihira|gihira","kigembe|kigembe","nkingo|nkingo"];
         }
		  else if(s5.value=="karama"){
           var optionArray = ["|","bitare|bitare","bunyonga|bunyonga","muganza|Muganza","nyamirembe|nyamirembe"];
         }
		 else if(s5.value=="kayenzi"){
           var optionArray = ["|","bugarama|bugarama","cubi|cubi","kayonza|kayonza","kirwa|kirwa","mataba|mataba","nyamirama|nyamirama"];
         }
		  else if(s5.value=="kayumbu"){
           var optionArray = ["|","busoro|busoro","gaseke|gaseke","giko|giko","muyange|muyange"];
         }
		 else if(s5.value=="mugina"){
           var optionArray = ["|","jenda|jenda","kabugondo|kabugondo","mbati|mbati","mugina|mugina","nteko|nteko"];
         }
		 else if(s5.value=="musambira"){
           var optionArray = ["|","buhoro|buhoro","cyambwe|cyambwe","karengera|karengera","kivumu|kivumu","mpushi|mpushi","rukambura|rukambura"];
         }
		  else if(s5.value=="ngamba"){
           var optionArray = ["|","kabuga|kabuga","kazirabonde|kazirabonde","marembo|marembo"];
         }
		  else if(s5.value=="musambira"){
           var optionArray = ["|","buhoro|buhoro","cyambwe|cyambwe","karengera|karengera","kivumu|kivumu","mpushi|mpushi","rukambura|rukambura"];
         }
		  else if(s5.value=="nyamiyaga"){
           var optionArray = ["|","bibungo|bibungo","kabashumba|kabashumba","kidahwe|kidahwa","mukinga|mukinga","ngoma|ngabo"];
         }
		  else if(s5.value=="nyarubaka"){
           var optionArray = ["|","gitare|gitare","kambyeyi|kambyeyi","kigusa|kigusa","nyagishubi|nyagishubi","ruyanza|ruyanza"];
         }
		 else if(s5.value=="rugalika"){
           var optionArray = ["|","bihembe|bihembe","kigese|kigese","masaka|masaka","nyarubuye|nyarubuye","sheli|sheli"];
         }
		 else if(s5.value=="rukomo"){
           var optionArray = ["|","bugoba|bugoba","buguri|buguri","gishyeshye|gishyeshye","murehe|murehe","mwirute|mwirute","remera|remera","taba|taba"];
         }
		 else if(s5.value=="runda"){
           var optionArray = ["|","gihara|gihara","kabagesera|kabagesera","kagina|kagina","muganza|muganza","ruyenzi|ruyenzi"];
         }
         else if(s5.value=="shyogwe"){
           var optionArray = ["|","kinini|kinini","musezero|musezero","mapfundo|mapfundo","mbare|mbare","mubuga|mubuga","ruli|ruli"];
         }
         else if(s5.value=="save"){
            var optionArray = ["|","gatoki|gatoki","munazi|munazi","shyanda|shyanda","rwanza|rwanza"];
         }
          for(var option in optionArray){
              var pair= optionArray[option].split("|");
              var newOption=document.createElement("option");
              newOption.value = pair[0];
              newOption.innerHTML = pair[1];
              s6.options.add( newOption);
          }
          }
            