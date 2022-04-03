/**
 * Validator for unit values.
 *
 * No units are allowed to be empty. Disc and book units must be a number
 * with no more than two decimal places. Furniture units must be three numbers
 * with no more than two decimal places surrounded by x characters (e.g. 1x2x3).
 *
 * @param string The unit value to validate.
 * @param string The type of unit value.
 * @returns The validation result.
 */
export const validateUnitValue = (string: string, type: string): boolean => {
  if (type === 'DISC' || type === 'BOOK') {
    const regex = /^\d+(\.\d{0,2})?$/;
    return regex.test(string);
  }

  if (type === 'FURNITURE') {
    const regex = /^\d+(\.\d{0,2})?x\d+(\.\d{0,2})?x\d+(\.\d{0,2})?$/;
    return regex.test(string);
  }

  return false;
};
