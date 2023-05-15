let get_page = document.querySelector("body")
if (get_page)
{
    let get_page1 = get_page.classList.contains("page-id-188")
    if(get_page1){
        let get_el = document.querySelector(".benefit_sec")
        if (get_el)
        {
            get_el.classList.add("partners")
        }
    }
}


var wpcf7Elm1 = document.querySelector( '.single_blog_sidebar .wpcf7' );
if (wpcf7Elm1){   
    wpcf7Elm1.addEventListener( 'wpcf7mailsent', function( event ) {
        let link_url = document.querySelector('.download-a').dataset.url
        link_url = atob(link_url)
        let link_name = document.querySelector('.download-a').dataset.name
        let link = document.createElement("a");
        link.setAttribute('download', `${link_name}`);
        link.href = link_url;
        document.body.appendChild(link);
        link.click();
        link.remove();
    }, false )
}

let get_jobs_cat_class = document.querySelectorAll(".jobs-cat-class")
let subdivaaa = document.querySelectorAll(".all_section_wrapper > div");
subdivaaa.forEach(function(el){    
    el.dataset.elheight = el.offsetHeight
    el.style.height = el.offsetHeight
})


let ggg = document.querySelector(".job_sidebar_categories")
if(ggg){

    ggg.addEventListener("click", function(e){

        if(e.target.classList.contains("target_c"))
        {

            let sibl = e.target.closest("ul").querySelectorAll("li")

            sibl.forEach(function(itemli){
                itemli.classList.remove("current")
            })

            e.target.parentElement.classList.add("current")

            subdivaaa.forEach(function(j){
                console.log('testest');
                j.style.opacity = 0
                j.style.height = 0
                j.style.overflow ="hidden"
            })

            let get_cat = e.target.dataset.uniqid

            let cat_div = document.querySelector(`.${get_cat}`)
            cat_div.style.opacity = 1
            cat_div.style.height = cat_div.dataset.elheight
        }
    })
}
