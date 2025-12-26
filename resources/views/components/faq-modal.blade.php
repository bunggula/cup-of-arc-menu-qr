<button @click="faqOpen = true" 
    class="fixed bottom-6 right-6 bg-orange-600 text-white p-4 rounded-full shadow-2xl z-40 hover:scale-110 active:scale-95 transition-all focus:outline-none">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
    </svg>
</button>

<div x-show="faqOpen" 
     x-data="{ 
        activeFaq: null, 
        displayText: '', 
        isTyping: false,
        faqs: {{ $faqs->toJson() }},
        typeWriter(text) {
            this.isTyping = true;
            this.displayText = '';
            let i = 0;
            let interval = setInterval(() => {
                this.displayText += text.charAt(i);
                i++;
                if (i >= text.length) {
                    clearInterval(interval);
                    this.isTyping = false;
                }
            }, 20); // Speed of typing (ms)
        }
     }"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-10 scale-95"
     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
     x-transition:leave="transition ease-in duration-200"
     class="fixed inset-0 z-50 bg-stone-50 overflow-hidden flex flex-col" 
     style="display: none;">
    
    <div class="bg-white border-b p-4 flex justify-between items-center shadow-sm">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-orange-600 rounded-full flex items-center justify-center text-xl shadow-inner">🤖</div>
            <div>
                <h2 class="text-sm font-black text-stone-800 uppercase tracking-tighter">CupOfArc <span class="text-orange-600 italic">Concierge</span></h2>
                <div class="flex items-center text-[10px] text-green-500 font-bold uppercase">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse mr-1"></span> System Active
                </div>
            </div>
        </div>
        <button @click="faqOpen = false" class="p-2 hover:bg-stone-100 rounded-full transition text-stone-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto p-4 space-y-6">
        
        <div class="flex justify-start">
            <div class="bg-white border border-stone-100 text-stone-700 p-4 rounded-2xl rounded-tl-none shadow-sm max-w-[85%] text-sm">
                Hello! I'm your CupOfArc assistant. How can I help you enjoy your coffee experience today?
            </div>
        </div>

        <div class="space-y-3">
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest ml-1">Suggested Inquiries</p>
            <div class="flex flex-wrap gap-2">
                <template x-for="faq in faqs" :key="faq.id">
                    <button @click="activeFaq = faq.id; typeWriter(faq.answer)" 
                        :disabled="isTyping"
                        :class="activeFaq === faq.id ? 'bg-orange-600 text-white border-orange-600' : 'bg-white text-stone-600 border-stone-200 hover:border-orange-400'"
                        class="px-4 py-2 rounded-2xl border text-xs font-medium transition-all shadow-sm disabled:opacity-50">
                        <span x-text="faq.question"></span>
                    </button>
                </template>
            </div>
        </div>

        <div x-show="activeFaq" class="space-y-4">
            <div class="flex justify-end">
                <div class="bg-stone-200 text-stone-700 p-3 rounded-2xl rounded-tr-none text-xs shadow-sm max-w-[80%]">
                    <template x-for="faq in faqs">
                        <span x-show="activeFaq === faq.id" x-text="faq.question"></span>
                    </template>
                </div>
            </div>

            <div class="flex justify-start items-start space-x-2">
                <div class="w-8 h-8 bg-orange-600 rounded-full flex-shrink-0 flex items-center justify-center text-xs shadow-md">🤖</div>
                <div class="bg-orange-50 border border-orange-100 text-stone-800 p-4 rounded-2xl rounded-tl-none shadow-sm max-w-[85%] text-sm min-h-[60px]">
                    <div x-show="isTyping && displayText === ''" class="flex space-x-1 py-2">
                        <div class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-bounce"></div>
                        <div class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-bounce [animation-delay:0.2s]"></div>
                        <div class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-bounce [animation-delay:0.4s]"></div>
                    </div>
                    
                    <p class="leading-relaxed" x-text="displayText"></p>

                    <div x-show="!isTyping" x-transition class="mt-3 pt-3 border-t border-orange-200 text-[10px] text-orange-400 font-medium flex justify-between items-center">
                        <span>Was this helpful? ☕</span>
                        <div class="flex space-x-2">
                            <button class="hover:text-orange-600">Yes</button>
                            <button class="hover:text-orange-600">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    </div>
</div>