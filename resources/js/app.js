import './bootstrap'

import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import PerfectScrollbar from 'perfect-scrollbar'

import Inputmask from 'inputmask'

document.addEventListener("DOMContentLoaded", function (){
    //Calendário no input de data
    flatpickr(".date", {
        dateFormat: "d/m/Y",  
        allowInput: true,     
        locale: "pt",
        minDate: "01/01/1960",
        maxDate: "today",  
    });

    // Aplicar o Flatpickr com a opção de intervalo de datas 
    flatpickr(".date-range", { 
        mode: "range", // para filtragem entre datas
        dateFormat: "d/m/Y", 
        locale: "pt", 
        allowInput: true, 
        minDate: "01/01/1960",
        maxDate: "today",
    });

    var dateRangeMask = new Inputmask({
        mask: "99/99/9999 até 99/99/9999",
        definitions: {
            'a': {  // Definindo a máscara para o "a" como texto fixo
              validator: "[a]", // Permite o "a" como texto fixo
              cardinality: 1,
              prevalidator: []
            }
        }
    });
    dateRangeMask.mask(document.querySelectorAll('.date-range'));

    var dateMask = new Inputmask("99/99/9999");
    dateMask.mask(document.querySelectorAll('.date'));

    var monthYearMask = new Inputmask("99/9999");
    monthYearMask.mask(document.querySelectorAll('.monthYear'));

    var cellphoneMask = new Inputmask("(99) 99999-9999");
    cellphoneMask.mask(document.querySelectorAll('.cellphone'));

    var rgMask = new Inputmask("99.999.999-9");
    rgMask.mask(document.querySelectorAll('.rg'));

    var fiscalMask = new Inputmask("999.999.999");
    fiscalMask.mask(document.querySelector('#fiscal'));
});

window.PerfectScrollbar = PerfectScrollbar

document.addEventListener('alpine:init', () => {
    Alpine.data('mainState', () => {
        let lastScrollTop = 0
        const init = function () {
            window.addEventListener('scroll', () => {
                let st = window.pageYOffset || document.documentElement.scrollTop
                if (st > lastScrollTop) {
                    // downscroll
                    this.scrollingDown = true
                    this.scrollingUp = false
                } else {
                    // upscroll
                    this.scrollingDown = false
                    this.scrollingUp = true
                    if (st === 0) {
                        //  reset
                        this.scrollingDown = false
                        this.scrollingUp = false
                    }
                }
                lastScrollTop = st <= 0 ? 0 : st
            })

            // Restore sidebar state from localStorage
            const storedSidebarState = window.localStorage.getItem('isSidebarOpen');
            this.isSidebarOpen = storedSidebarState !== null ? JSON.parse(storedSidebarState) : (window.innerWidth > 1024);
            
            // Adjust sidebar visibility based on initial window size
            if (window.innerWidth <= 1024) {
                this.isSidebarOpen = false;
            }
        }

        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }
            return (
                !!window.matchMedia &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            )
        }
        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }
        return {
            init,
            isDarkMode: getTheme(),
            toggleTheme() {
                this.isDarkMode = !this.isDarkMode
                setTheme(this.isDarkMode)
            },
            isSidebarOpen: JSON.parse(window.localStorage.getItem('isSidebarOpen')) ?? (window.innerWidth > 1024),
            isSidebarHovered: false,
            handleSidebarHover(value) {
                if (window.innerWidth < 1024) {
                    return
                }
                this.isSidebarHovered = value
            },
            handleWindowResize() {
                if (window.innerWidth <= 1024) {
                    this.isSidebarOpen = false
                } else {
                    this.isSidebarOpen = true
                }
                window.localStorage.setItem('isSidebarOpen', JSON.stringify(this.isSidebarOpen))
            },
            toggleSidebar() {
                this.isSidebarOpen = !this.isSidebarOpen
                window.localStorage.setItem('isSidebarOpen', JSON.stringify(this.isSidebarOpen))
            },
            scrollingDown: false,
            scrollingUp: false,
        }
    })
})

Alpine.plugin(collapse)

Alpine.start()
