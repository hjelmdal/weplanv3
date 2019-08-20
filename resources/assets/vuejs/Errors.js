export default class Errors {
    /**
     * Create a new Errors instance.
     */
    constructor() {
        this.errors = {};
    }


    /**
     * Determine if an errors exists for the given field.
     *
     * @param {string} field
     */
    has(field) {
        if(this.errors) {
            return this.errors.hasOwnProperty(field);
        } else {
            return false;
        }
    }


    /**
     * Determine if we have any errors.
     */
    any() {
        return Object.keys(this.errors).length > 0;
    }


    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    get(field,array = false) {
        if (this.errors[field]) {
            if(array == true) {
                return this.errors[field];
            }
            return this.errors[field][0];
        }
    }
    /**
     * Return the error messages for the entire object.
     *
     * @return {array} errors
     */
    getAll() {
        if(this.errors) {
            return this.errors;
        }
        return false;
    }



    /**
     * Record the new errors.
     *
     * @param {object} errors
     */
    record(errors) {
        this.errors = errors;
    }


    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }

}