document.addEventListener('DOMContentLoaded', function() {
    class Count {
        constructor() {
            this.textArea = document.querySelector('.count_textarea');
            this.wordCount = document.querySelector('.word-count');
            this.charCount = document.querySelector('.character-count');
            this.npCharCount = document.querySelector('.npcharacter-count');
            this.smsParts = document.querySelector('.parts-count'); // Reference to the element for displaying SMS parts
            
            this.textArea.addEventListener('input', this.updateCount.bind(this));
            this.updateCount();
        }

        countWords() {
            const value = this.textArea.value.trim();
            if (!value) return 0;
            return value.split(/\s+/).length;
        }

        countChars() {
            const value = this.textArea.value.trim();
            let count = 0;
            for (let i = 0; i < value.length; i++) {
                const charCode = value.charCodeAt(i);
                if (charCode >= 0xD800 && charCode <= 0xDBFF) {
                    // High surrogate, check next character for low surrogate
                    if (i < value.length - 1) {
                        const nextCharCode = value.charCodeAt(i + 1);
                        if (nextCharCode >= 0xDC00 && nextCharCode <= 0xDFFF) {
                            // Low surrogate, increment count and skip next character
                            count++;
                            i++;
                            continue;
                        }
                    }
                }
                // Not part of a surrogate pair, count as one character
                count++;
            }
            return count;
        }

        countNonPlainChars() {
            const value = this.textArea.value.trim();
            let count = 0;
            for (let i = 0; i < value.length; i++) {
                const charCode = value.charCodeAt(i);
                if (charCode > 127 || charCode < 32) {
                    count++;
                }
            }
            return count;
        }

        calculateSMSParts() {
            const numChars = this.countChars();
            const isPlain = numChars <= 160; // Check if the message is plain (length <= 160) or Unicode
            const smsParts = isPlain ? 1 : Math.ceil(numChars / (isPlain ? 153 : 67)); // Calculate SMS parts based on message length and whether it's plain or Unicode
            return smsParts;
        }

        updateCount() {
            const numWords = this.countWords();
            const numChars = this.countChars();
            const numNonPlainChars = this.countNonPlainChars();
            const smsParts = this.calculateSMSParts(); // Calculate SMS parts

            this.wordCount.textContent = numWords.toString(10);
            this.charCount.textContent = numChars.toString(10);
            this.npCharCount.textContent = numNonPlainChars.toString(10);
            this.smsParts.textContent = smsParts.toString(10); // Update the SMS parts count
        }
    }

    new Count();
});
