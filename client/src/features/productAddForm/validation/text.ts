/**
 * Validator for sku and name inputs.
 *
 * @param text The sku or name to validate.
 * @returns The validation result.
 */
export const validateText = (text: string): boolean => text.length > 0;
