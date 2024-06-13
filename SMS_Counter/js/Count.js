document.addEventListener('DOMContentLoaded', function() {
    class Count {
        constructor() {
            this.textArea = document.querySelector('.count_textarea');
            this.wordCount = document.querySelector('.word-count'); // Changed from querySelectorAll to querySelector
            this.charCount = document.querySelector('.character-count'); // Changed from querySelectorAll to querySelector
            this.textArea.addEventListener('input', this.updateCount.bind(this)); // Moved the event listener here
            this.updateCount(); // Call updateCount initially to set initial counts
        }

        countWords() {
            const value = this.textArea.value.trim();
            if (!value) return 0;
            return value.split(/\s+/).length; // Counts everything on line separated by spaces '/\s+/)' Regex expression which counts one or more whitespaces('s+')
        }

        countChars() {
            return this.textArea.value.length;
        }

        updateCount() {
            const numWords = this.countWords();
            const numChars = this.countChars();

            this.wordCount.textContent = numWords.toString(10); // Changed to update single wordCount element
            this.charCount.textContent = numChars.toString(10); // Changed to update single charCount element
        }
    }

    new Count();
});
