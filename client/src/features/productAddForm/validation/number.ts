/**
 * Validator for decimal number inputs up to two decimal places.
 *
 * @param number The number to validate.
 * @returns The validation result.
 */
export const validateNumber = (number: string): boolean => {
  const regex = /^\d+(\.\d{0,2})?$/;

  return regex.test(number);
};
